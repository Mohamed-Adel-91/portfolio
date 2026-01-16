<?php

namespace App\Services\PersonalDashboard;

use App\Models\TodoCategory;
use App\Models\TodoTask;
use App\Models\TodoTaskItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PlannerInsightsService
{
    public function buildCalendarGrid(int $year, int $month, array $filters = []): array
    {
        $timezone = config('app.timezone', 'UTC');
        $monthStart = Carbon::createFromDate($year, $month, 1, $timezone)->startOfDay();
        $monthEnd = $monthStart->copy()->endOfMonth()->endOfDay();

        $gridStart = $monthStart->copy()->startOfWeek(Carbon::MONDAY);
        $gridEnd = $monthEnd->copy()->endOfWeek(Carbon::SUNDAY);

        $days = collect();
        for ($cursor = $gridStart->copy(); $cursor->lte($gridEnd); $cursor->addDay()) {
            $days->push($cursor->copy());
        }

        $filters = $this->normalizeFilters($filters);
        $range = [$gridStart->toDateString(), $gridEnd->toDateString()];

        $items = collect();
        if ($filters['include_items']) {
            $itemQuery = TodoTaskItem::query()
                ->with(['task.category'])
                ->whereBetween('scheduled_date', $range);
            $this->applyItemFilters($itemQuery, $filters);
            $items = $itemQuery->get();
        }

        $tasks = collect();
        if ($filters['include_tasks']) {
            $taskQuery = TodoTask::query()
                ->with('category')
                ->whereBetween('scheduled_date', $range);
            $this->applyTaskFilters($taskQuery, $filters);
            $tasks = $taskQuery->get();
        }

        $itemsByDate = $items->groupBy(function (TodoTaskItem $item) {
            return $item->scheduled_date ? $item->scheduled_date->toDateString() : 'unscheduled';
        });

        $tasksByDate = $tasks->groupBy(function (TodoTask $task) {
            return $task->scheduled_date ? $task->scheduled_date->toDateString() : 'unscheduled';
        });

        $unscheduledItems = collect();
        if ($filters['include_items']) {
            $unscheduledItemsQuery = TodoTaskItem::query()
                ->with(['task.category'])
                ->whereNull('scheduled_date')
                ->where('status', TodoTaskItem::STATUS_OPEN);
            $this->applyItemFilters($unscheduledItemsQuery, $filters, true);
            $unscheduledItems = $unscheduledItemsQuery->get();
        }

        $unscheduledTasks = collect();
        if ($filters['include_tasks']) {
            $unscheduledTasksQuery = TodoTask::query()
                ->with('category')
                ->whereNull('scheduled_date')
                ->whereIn('status', [TodoTask::STATUS_OPEN, TodoTask::STATUS_IN_PROGRESS]);
            $this->applyTaskFilters($unscheduledTasksQuery, $filters, true);
            $unscheduledTasks = $unscheduledTasksQuery->get();
        }

        $counts = $this->monthlyAggregates($monthStart, $monthEnd, $filters, $items, $tasks);

        return [
            'monthStart' => $monthStart,
            'monthEnd' => $monthEnd,
            'gridStart' => $gridStart,
            'gridEnd' => $gridEnd,
            'days' => $days,
            'itemsByDate' => $itemsByDate,
            'tasksByDate' => $tasksByDate,
            'unscheduledItems' => $unscheduledItems,
            'unscheduledTasks' => $unscheduledTasks,
            'counts' => $counts,
        ];
    }

    public function monthlyAggregates(
        Carbon $start,
        Carbon $end,
        array $filters = [],
        ?Collection $items = null,
        ?Collection $tasks = null
    ): array {
        $filters = $this->normalizeFilters($filters);
        $rangeStart = $start->copy()->startOfDay();
        $rangeEnd = $end->copy()->endOfDay();

        if ($items === null || $tasks === null) {
            [$items, $tasks] = $this->loadRangeData($rangeStart, $rangeEnd, $filters);
        }

        $items = $items->filter(function (TodoTaskItem $item) use ($rangeStart, $rangeEnd) {
            return $item->scheduled_date
                && $item->scheduled_date->betweenIncluded($rangeStart, $rangeEnd);
        });

        $tasks = $tasks->filter(function (TodoTask $task) use ($rangeStart, $rangeEnd) {
            return $task->scheduled_date
                && $task->scheduled_date->betweenIncluded($rangeStart, $rangeEnd);
        });

        return [
            'scheduled_items' => $items->count(),
            'done_items' => $items->where('status', TodoTaskItem::STATUS_DONE)->count(),
            'open_items' => $items->where('status', TodoTaskItem::STATUS_OPEN)->count(),
            'scheduled_tasks' => $tasks->count(),
            'done_tasks' => $tasks->where('status', TodoTask::STATUS_DONE)->count(),
            'open_tasks' => $tasks->whereIn('status', [TodoTask::STATUS_OPEN, TodoTask::STATUS_IN_PROGRESS])->count(),
        ];
    }

    public function annualAggregates(int $year, array $filters = []): array
    {
        $timezone = config('app.timezone', 'UTC');
        $yearStart = Carbon::createFromDate($year, 1, 1, $timezone)->startOfDay();
        $yearEnd = $yearStart->copy()->endOfYear()->endOfDay();

        $filters = $this->normalizeFilters($filters);
        [$items, $tasks] = $this->loadRangeData($yearStart, $yearEnd, $filters);

        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $months[$month] = [
                'scheduled' => 0,
                'done' => 0,
                'daily_counts' => [],
            ];
        }

        foreach ($items as $item) {
            $date = $item->scheduled_date;
            if (! $date) {
                continue;
            }
            $month = (int) $date->format('n');
            $months[$month]['scheduled']++;
            if ($item->status === TodoTaskItem::STATUS_DONE) {
                $months[$month]['done']++;
            }
            $key = $date->toDateString();
            $months[$month]['daily_counts'][$key] = ($months[$month]['daily_counts'][$key] ?? 0) + 1;
        }

        foreach ($tasks as $task) {
            $date = $task->scheduled_date;
            if (! $date) {
                continue;
            }
            $month = (int) $date->format('n');
            $months[$month]['scheduled']++;
            if ($task->status === TodoTask::STATUS_DONE) {
                $months[$month]['done']++;
            }
            $key = $date->toDateString();
            $months[$month]['daily_counts'][$key] = ($months[$month]['daily_counts'][$key] ?? 0) + 1;
        }

        $quadrantCounts = array_fill_keys(array_keys(TodoTask::quadrantOptions()), 0);
        $starCounts = array_fill_keys(range(1, 5), 0);
        $categoryCounts = [];
        $doneDates = [];

        foreach ($items as $item) {
            $task = $item->task;
            if ($task) {
                $quadrantCounts[$task->quadrant] = ($quadrantCounts[$task->quadrant] ?? 0) + 1;
                $starCounts[$task->stars] = ($starCounts[$task->stars] ?? 0) + 1;
                $categoryLabel = $this->categoryLabel($task->category);
                $categoryCounts[$categoryLabel] = ($categoryCounts[$categoryLabel] ?? 0) + 1;
            }
            if ($item->status === TodoTaskItem::STATUS_DONE && $item->scheduled_date) {
                $doneDates[] = $item->scheduled_date->toDateString();
            }
        }

        foreach ($tasks as $task) {
            $quadrantCounts[$task->quadrant] = ($quadrantCounts[$task->quadrant] ?? 0) + 1;
            $starCounts[$task->stars] = ($starCounts[$task->stars] ?? 0) + 1;
            $categoryLabel = $this->categoryLabel($task->category);
            $categoryCounts[$categoryLabel] = ($categoryCounts[$categoryLabel] ?? 0) + 1;

            if ($task->status === TodoTask::STATUS_DONE && $task->scheduled_date) {
                $doneDates[] = $task->scheduled_date->toDateString();
            }
        }

        arsort($categoryCounts);
        $topCategories = collect($categoryCounts)
            ->map(function ($count, $name) {
                return ['name' => $name, 'count' => $count];
            })
            ->values()
            ->take(5)
            ->all();

        $totalCount = $items->count() + $tasks->count();
        $doneCount = $items->where('status', TodoTaskItem::STATUS_DONE)->count()
            + $tasks->where('status', TodoTask::STATUS_DONE)->count();
        $doneRate = $totalCount > 0 ? round(($doneCount / $totalCount) * 100, 1) : 0;

        $longestStreak = $this->computeLongestStreak($doneDates, $timezone);

        $calendars = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthStart = Carbon::createFromDate($year, $month, 1, $timezone)->startOfDay();
            $monthEnd = $monthStart->copy()->endOfMonth();
            $gridStart = $monthStart->copy()->startOfWeek(Carbon::MONDAY);
            $gridEnd = $monthEnd->copy()->endOfWeek(Carbon::SUNDAY);

            $days = collect();
            for ($cursor = $gridStart->copy(); $cursor->lte($gridEnd); $cursor->addDay()) {
                $days->push($cursor->copy());
            }

            $calendars[$month] = [
                'monthStart' => $monthStart,
                'days' => $days,
            ];
        }

        return [
            'months' => $months,
            'calendars' => $calendars,
            'topCategories' => $topCategories,
            'quadrantCounts' => $quadrantCounts,
            'starCounts' => $starCounts,
            'doneRate' => $doneRate,
            'longestStreak' => $longestStreak,
            'totalCount' => $totalCount,
            'doneCount' => $doneCount,
        ];
    }

    public function kpiAggregates(Carbon $start, Carbon $end, array $filters = []): array
    {
        $timezone = config('app.timezone', 'UTC');
        $filters = $this->normalizeFilters($filters);
        $rangeStart = $start->copy()->startOfDay();
        $rangeEnd = $end->copy()->endOfDay();

        [$items, $tasks] = $this->loadRangeData($rangeStart, $rangeEnd, $filters);

        $doneItems = $items->where('status', TodoTaskItem::STATUS_DONE);
        $doneTasks = $tasks->where('status', TodoTask::STATUS_DONE);

        $totalCount = $items->count() + $tasks->count();
        $doneCount = $doneItems->count() + $doneTasks->count();
        $completionRate = $totalCount > 0 ? round(($doneCount / $totalCount) * 100, 1) : 0;

        $weekBuckets = $this->buildWeekBuckets($rangeStart, $rangeEnd);

        foreach ($doneItems as $item) {
            $completionDate = $item->completed_at ?? $item->scheduled_date;
            if (! $completionDate) {
                continue;
            }
            $this->incrementWeekBucket($weekBuckets, $completionDate, $rangeStart, $rangeEnd, $timezone);
        }

        foreach ($doneTasks as $task) {
            $completionDate = $task->completed_at ?? $task->scheduled_date;
            if (! $completionDate) {
                continue;
            }
            $this->incrementWeekBucket($weekBuckets, $completionDate, $rangeStart, $rangeEnd, $timezone);
        }

        $quadrantCounts = array_fill_keys(array_keys(TodoTask::quadrantOptions()), 0);
        $starCounts = array_fill_keys(range(1, 5), 0);
        $categoryCounts = [];

        foreach ($items as $item) {
            $task = $item->task;
            if (! $task) {
                continue;
            }
            $quadrantCounts[$task->quadrant] = ($quadrantCounts[$task->quadrant] ?? 0) + 1;
            $starCounts[$task->stars] = ($starCounts[$task->stars] ?? 0) + 1;
            $categoryLabel = $this->categoryLabel($task->category);
            $categoryCounts[$categoryLabel] = ($categoryCounts[$categoryLabel] ?? 0) + 1;
        }

        foreach ($tasks as $task) {
            $quadrantCounts[$task->quadrant] = ($quadrantCounts[$task->quadrant] ?? 0) + 1;
            $starCounts[$task->stars] = ($starCounts[$task->stars] ?? 0) + 1;
            $categoryLabel = $this->categoryLabel($task->category);
            $categoryCounts[$categoryLabel] = ($categoryCounts[$categoryLabel] ?? 0) + 1;
        }

        arsort($categoryCounts);
        $categoryLeaderboard = collect($categoryCounts)
            ->map(function ($count, $name) {
                return ['name' => $name, 'count' => $count];
            })
            ->values()
            ->take(8)
            ->all();

        $plannedCount = $totalCount;
        $donePlannedCount = $doneCount;

        $overdueCount = 0;
        if ($filters['include_tasks']) {
            $today = Carbon::now($timezone)->startOfDay();
            $overdueQuery = TodoTask::query()
                ->whereNotNull('due_date')
                ->whereDate('due_date', '<', $today->toDateString());
            $this->applyTaskFilters($overdueQuery, $filters, true);

            if (! empty($filters['status'])) {
                if ($filters['status'] === TodoTask::STATUS_DONE) {
                    $overdueCount = 0;
                } else {
                    $overdueQuery->where('status', $filters['status']);
                    $overdueCount = $overdueQuery->count();
                }
            } else {
                $overdueCount = $overdueQuery->where('status', '!=', TodoTask::STATUS_DONE)->count();
            }
        }

        return [
            'totalCount' => $totalCount,
            'doneCount' => $doneCount,
            'completionRate' => $completionRate,
            'throughput' => $weekBuckets,
            'quadrantCounts' => $quadrantCounts,
            'starCounts' => $starCounts,
            'overdueCount' => $overdueCount,
            'plannedCount' => $plannedCount,
            'donePlannedCount' => $donePlannedCount,
            'categoryLeaderboard' => $categoryLeaderboard,
        ];
    }

    public function exportRows(Carbon $start, Carbon $end, array $filters = []): array
    {
        $filters = $this->normalizeFilters($filters);
        [$items, $tasks] = $this->loadRangeData($start, $end, $filters);

        $rows = [];

        foreach ($items as $item) {
            $task = $item->task;
            $rows[] = [
                'type' => 'item',
                'id' => $item->id,
                'title' => $item->title,
                'status' => $item->status,
                'scheduled_date' => optional($item->scheduled_date)->toDateString(),
                'completed_at' => optional($item->completed_at)->toDateTimeString(),
                'parent_task' => $task?->title,
                'category' => $task?->category?->name,
                'quadrant' => $task?->quadrant,
                'stars' => $task?->stars,
            ];
        }

        foreach ($tasks as $task) {
            $rows[] = [
                'type' => 'task',
                'id' => $task->id,
                'title' => $task->title,
                'status' => $task->status,
                'scheduled_date' => optional($task->scheduled_date)->toDateString(),
                'completed_at' => optional($task->completed_at)->toDateTimeString(),
                'parent_task' => null,
                'category' => $task->category?->name,
                'quadrant' => $task->quadrant,
                'stars' => $task->stars,
            ];
        }

        return $rows;
    }

    private function normalizeFilters(array $filters): array
    {
        $includeItems = array_key_exists('include_items', $filters)
            ? (bool) $filters['include_items']
            : true;
        $includeTasks = array_key_exists('include_tasks', $filters)
            ? (bool) $filters['include_tasks']
            : true;

        if (! $includeItems && ! $includeTasks) {
            $includeItems = true;
            $includeTasks = true;
        }

        $status = $filters['status'] ?? null;
        if (is_string($status) && trim($status) === '') {
            $status = null;
        }

        return [
            'category_id' => $filters['category_id'] ?? null,
            'quadrant' => $filters['quadrant'] ?? null,
            'stars_min' => $filters['stars_min'] ?? null,
            'status' => $status,
            'include_items' => $includeItems,
            'include_tasks' => $includeTasks,
        ];
    }

    private function applyTaskFilters(Builder $query, array $filters, bool $ignoreStatus = false): void
    {
        if (! $ignoreStatus && ! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['category_id'])) {
            $query->where('todo_category_id', $filters['category_id']);
        }

        if (! empty($filters['quadrant'])) {
            $query->where('quadrant', $filters['quadrant']);
        }

        if (! empty($filters['stars_min'])) {
            $query->where('stars', '>=', $filters['stars_min']);
        }
    }

    private function applyItemFilters(Builder $query, array $filters, bool $ignoreStatus = false): void
    {
        if (! $ignoreStatus && ! empty($filters['status'])) {
            if (! in_array($filters['status'], [TodoTaskItem::STATUS_OPEN, TodoTaskItem::STATUS_DONE], true)) {
                $query->whereRaw('1 = 0');
                return;
            }
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['category_id'])) {
            $query->whereHas('task', function (Builder $builder) use ($filters) {
                $builder->where('todo_category_id', $filters['category_id']);
            });
        }

        if (! empty($filters['quadrant'])) {
            $query->whereHas('task', function (Builder $builder) use ($filters) {
                $builder->where('quadrant', $filters['quadrant']);
            });
        }

        if (! empty($filters['stars_min'])) {
            $query->whereHas('task', function (Builder $builder) use ($filters) {
                $builder->where('stars', '>=', $filters['stars_min']);
            });
        }
    }

    private function loadRangeData(Carbon $start, Carbon $end, array $filters): array
    {
        $range = [$start->toDateString(), $end->toDateString()];

        $items = collect();
        if ($filters['include_items']) {
            $itemQuery = TodoTaskItem::query()
                ->with(['task.category'])
                ->whereBetween('scheduled_date', $range);
            $this->applyItemFilters($itemQuery, $filters);
            $items = $itemQuery->get();
        }

        $tasks = collect();
        if ($filters['include_tasks']) {
            $taskQuery = TodoTask::query()
                ->with('category')
                ->whereBetween('scheduled_date', $range);
            $this->applyTaskFilters($taskQuery, $filters);
            $tasks = $taskQuery->get();
        }

        return [$items, $tasks];
    }

    private function buildWeekBuckets(Carbon $start, Carbon $end): array
    {
        $buckets = [];
        $cursor = $start->copy()->startOfWeek(Carbon::MONDAY);
        $last = $end->copy()->endOfWeek(Carbon::SUNDAY);

        while ($cursor->lte($last)) {
            $key = $cursor->format('o-\WW');
            $buckets[$key] = [
                'label' => $cursor->format('M d'),
                'count' => 0,
            ];
            $cursor->addWeek();
        }

        return $buckets;
    }

    private function incrementWeekBucket(
        array &$buckets,
        $date,
        Carbon $start,
        Carbon $end,
        string $timezone
    ): void {
        $completed = $date instanceof Carbon
            ? $date->copy()
            : Carbon::parse($date, $timezone);

        if (! $completed->betweenIncluded($start, $end)) {
            return;
        }

        $bucketKey = $completed->copy()->startOfWeek(Carbon::MONDAY)->format('o-\WW');
        if (isset($buckets[$bucketKey])) {
            $buckets[$bucketKey]['count']++;
        }
    }

    private function categoryLabel(?TodoCategory $category): string
    {
        return $category?->name ?? 'Uncategorized';
    }

    private function computeLongestStreak(array $dateStrings, string $timezone): int
    {
        $dates = collect($dateStrings)
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $max = 0;
        $current = 0;
        $previous = null;

        foreach ($dates as $dateString) {
            $date = Carbon::parse($dateString, $timezone)->startOfDay();
            if ($previous && $previous->diffInDays($date) === 1) {
                $current++;
            } else {
                $current = 1;
            }
            $max = max($max, $current);
            $previous = $date;
        }

        return $max;
    }
}
