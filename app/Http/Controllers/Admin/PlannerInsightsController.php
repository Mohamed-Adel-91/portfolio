<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KpiFilterRequest;
use App\Models\TodoCategory;
use App\Models\TodoTask;
use App\Services\PersonalDashboard\PlannerInsightsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PlannerInsightsController extends Controller
{
    public function monthly(
        Request $request,
        PlannerInsightsService $service,
        ?string $year = null,
        ?string $month = null
    ): View {
        $timezone = config('app.timezone', 'UTC');
        $now = Carbon::now($timezone);
        $resolvedYear = $this->resolveYear($year, $now->year);
        $resolvedMonth = $this->resolveMonth($month, $now->month);

        $filters = $this->extractFilters($request);
        $calendar = $service->buildCalendarGrid($resolvedYear, $resolvedMonth, $filters);

        $categories = TodoCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $parentTasks = TodoTask::query()
            ->whereIn('status', [TodoTask::STATUS_OPEN, TodoTask::STATUS_IN_PROGRESS])
            ->orderBy('title')
            ->get();

        $dayPayloads = $this->buildDayPayloads(
            $calendar['days'],
            $calendar['itemsByDate'],
            $calendar['tasksByDate']
        );

        $prev = $calendar['monthStart']->copy()->subMonthNoOverflow();
        $next = $calendar['monthStart']->copy()->addMonthNoOverflow();

        return view('admin.personal-dashboard.monthly-planner.show', [
            'pageName' => 'Monthly Planner',
            'monthStart' => $calendar['monthStart'],
            'monthEnd' => $calendar['monthEnd'],
            'days' => $calendar['days'],
            'itemsByDate' => $calendar['itemsByDate'],
            'tasksByDate' => $calendar['tasksByDate'],
            'unscheduledItems' => $calendar['unscheduledItems'],
            'unscheduledTasks' => $calendar['unscheduledTasks'],
            'counts' => $calendar['counts'],
            'prevMonth' => $prev,
            'nextMonth' => $next,
            'categories' => $categories,
            'parentTasks' => $parentTasks,
            'filters' => $filters,
            'dayPayloads' => $dayPayloads,
            'statusOptions' => TodoTask::statusOptions(),
            'quadrantOptions' => TodoTask::quadrantOptions(),
        ]);
    }

    public function annual(
        Request $request,
        PlannerInsightsService $service,
        ?string $year = null
    ): View {
        $timezone = config('app.timezone', 'UTC');
        $now = Carbon::now($timezone);
        $resolvedYear = $this->resolveYear($year, $now->year);

        $filters = $this->extractFilters($request);
        $aggregates = $service->annualAggregates($resolvedYear, $filters);

        $categories = TodoCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.personal-dashboard.annual-planner.show', [
            'pageName' => 'Annual Planner',
            'year' => $resolvedYear,
            'prevYear' => $resolvedYear - 1,
            'nextYear' => $resolvedYear + 1,
            'months' => $aggregates['months'],
            'calendars' => $aggregates['calendars'],
            'topCategories' => $aggregates['topCategories'],
            'quadrantCounts' => $aggregates['quadrantCounts'],
            'starCounts' => $aggregates['starCounts'],
            'doneRate' => $aggregates['doneRate'],
            'longestStreak' => $aggregates['longestStreak'],
            'totalCount' => $aggregates['totalCount'],
            'doneCount' => $aggregates['doneCount'],
            'quadrantOptions' => TodoTask::quadrantOptions(),
            'filters' => $filters,
            'categories' => $categories,
        ]);
    }

    public function kpis(
        KpiFilterRequest $request,
        PlannerInsightsService $service
    ): View {
        $timezone = config('app.timezone', 'UTC');
        $now = Carbon::now($timezone);
        $validated = $request->validated();

        $rangeStart = array_key_exists('date_start', $validated)
            ? Carbon::parse($validated['date_start'], $timezone)->startOfDay()
            : $now->copy()->startOfMonth();
        $rangeEnd = array_key_exists('date_end', $validated)
            ? Carbon::parse($validated['date_end'], $timezone)->endOfDay()
            : $now->copy()->endOfDay();

        $filters = $this->extractFilters($request);

        $aggregates = $service->kpiAggregates($rangeStart, $rangeEnd, $filters);

        $categories = TodoCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.personal-dashboard.kpis.index', [
            'pageName' => 'KPIs & Analysis',
            'filters' => $filters,
            'rangeStart' => $rangeStart,
            'rangeEnd' => $rangeEnd,
            'categories' => $categories,
            'quadrantOptions' => TodoTask::quadrantOptions(),
            'statusOptions' => TodoTask::statusOptions(),
            'aggregates' => $aggregates,
        ]);
    }

    public function exportCsv(
        KpiFilterRequest $request,
        PlannerInsightsService $service
    ): StreamedResponse {
        $timezone = config('app.timezone', 'UTC');
        $now = Carbon::now($timezone);
        $validated = $request->validated();

        $rangeStart = array_key_exists('date_start', $validated)
            ? Carbon::parse($validated['date_start'], $timezone)->startOfDay()
            : $now->copy()->startOfMonth();
        $rangeEnd = array_key_exists('date_end', $validated)
            ? Carbon::parse($validated['date_end'], $timezone)->endOfDay()
            : $now->copy()->endOfDay();

        $filters = $this->extractFilters($request);
        $rows = $service->exportRows($rangeStart, $rangeEnd, $filters);

        $filename = 'kpis-export-' . $rangeStart->toDateString() . '-to-' . $rangeEnd->toDateString() . '.csv';

        return response()->streamDownload(function () use ($rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'type',
                'id',
                'title',
                'status',
                'scheduled_date',
                'completed_at',
                'parent_task',
                'category',
                'quadrant',
                'stars',
            ]);

            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function resolveYear(?string $year, int $fallback): int
    {
        if (! $year || ! ctype_digit($year)) {
            return $fallback;
        }

        $value = (int) $year;
        if ($value < 2000 || $value > 2100) {
            return $fallback;
        }

        return $value;
    }

    private function resolveMonth(?string $month, int $fallback): int
    {
        if (! $month || ! ctype_digit($month)) {
            return $fallback;
        }

        $value = (int) $month;
        if ($value < 1 || $value > 12) {
            return $fallback;
        }

        return $value;
    }

    private function extractFilters(Request $request): array
    {
        $filters = [
            'category_id' => $request->filled('category_id') ? (int) $request->input('category_id') : null,
            'quadrant' => $request->input('quadrant') ?: null,
            'stars_min' => $request->filled('stars_min') ? (int) $request->input('stars_min') : null,
            'status' => $request->input('status') ?: null,
            'include_items' => $request->boolean('include_items', false),
            'include_tasks' => $request->boolean('include_tasks', false),
        ];

        if (! $filters['include_items'] && ! $filters['include_tasks']) {
            $filters['include_items'] = true;
            $filters['include_tasks'] = true;
        }

        return $filters;
    }

    private function buildDayPayloads(Collection $days, $itemsByDate, $tasksByDate): array
    {
        $payloads = [];

        foreach ($days as $day) {
            $key = $day->toDateString();
            $items = ($itemsByDate[$key] ?? collect())->map(function ($item) {
                $task = $item->task;
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'status' => $item->status,
                    'scheduled_date' => optional($item->scheduled_date)->toDateString(),
                    'task' => $task ? [
                        'id' => $task->id,
                        'title' => $task->title,
                        'quadrant' => $task->quadrant,
                        'stars' => $task->stars,
                        'category' => $task->category?->name,
                        'category_color' => $task->category?->badge_color,
                    ] : null,
                ];
            })->values()->all();

            $tasks = ($tasksByDate[$key] ?? collect())->map(function ($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'status' => $task->status,
                    'scheduled_date' => optional($task->scheduled_date)->toDateString(),
                    'quadrant' => $task->quadrant,
                    'stars' => $task->stars,
                    'category' => $task->category?->name,
                    'category_color' => $task->category?->badge_color,
                ];
            })->values()->all();

            $payloads[$key] = [
                'items' => $items,
                'tasks' => $tasks,
            ];
        }

        return $payloads;
    }
}
