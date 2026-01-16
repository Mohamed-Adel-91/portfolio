<?php

namespace App\Http\Controllers\Admin\PersonalDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScheduleTaskRequest;
use App\Models\TodoCategory;
use App\Models\TodoTask;
use App\Models\TodoTaskItem;
use App\Models\WeeklyPlan;
use App\Services\PersonalDashboard\TodoTaskService;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WeeklyPlannerController extends Controller
{
    public function show(?string $weekStart = null): View
    {
        $timezone = config('app.timezone', 'Africa/Cairo');
        $now = Carbon::now($timezone);

        if ($weekStart) {
            try {
                $start = Carbon::createFromFormat('Y-m-d', $weekStart, $timezone);
            } catch (\Throwable $exception) {
                $start = $now->copy();
            }
        } else {
            $start = $now->copy();
        }

        $weekStartDate = $start->startOfWeek(Carbon::SUNDAY)->startOfDay();
        $weekEndDate = $weekStartDate->copy()->addDays(6);

        $days = collect(range(0, 6))
            ->map(fn (int $offset) => $weekStartDate->copy()->addDays($offset));

        $scheduledTasks = TodoTask::query()
            ->with('category')
            ->whereBetween('scheduled_date', [
                $weekStartDate->toDateString(),
                $weekEndDate->toDateString(),
            ])
            ->orderBy('scheduled_date')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $tasksByDay = $scheduledTasks->groupBy(function (TodoTask $task) {
            return $task->scheduled_date ? $task->scheduled_date->toDateString() : 'unscheduled';
        });

        $scheduledItems = TodoTaskItem::query()
            ->with(['task.category'])
            ->whereBetween('scheduled_date', [
                $weekStartDate->toDateString(),
                $weekEndDate->toDateString(),
            ])
            ->orderBy('scheduled_date')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $itemsByDay = $scheduledItems->groupBy(function (TodoTaskItem $item) {
            return $item->scheduled_date ? $item->scheduled_date->toDateString() : 'unscheduled';
        });

        $unscheduledTasks = TodoTask::query()
            ->with('category')
            ->whereNull('scheduled_date')
            ->whereIn('status', [TodoTask::STATUS_OPEN, TodoTask::STATUS_IN_PROGRESS])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $activeRangeTasks = TodoTask::query()
            ->with('category')
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->whereDate('start_date', '<=', $weekEndDate->toDateString())
            ->whereDate('end_date', '>=', $weekStartDate->toDateString())
            ->whereIn('status', [TodoTask::STATUS_OPEN, TodoTask::STATUS_IN_PROGRESS])
            ->orderBy('start_date')
            ->orderBy('end_date')
            ->get();

        $plan = WeeklyPlan::query()
            ->where('week_start_date', $weekStartDate->toDateString())
            ->first();

        $quadrantCounts = collect(TodoTask::quadrantOptions())
            ->mapWithKeys(function ($label, $value) use ($scheduledTasks) {
                return [$value => $scheduledTasks->where('quadrant', $value)->count()];
            })
            ->all();

        $doneCount = $scheduledTasks->where('status', TodoTask::STATUS_DONE)->count();
        $openCount = $scheduledTasks->whereIn('status', [TodoTask::STATUS_OPEN, TodoTask::STATUS_IN_PROGRESS])->count();

        $categories = TodoCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.personal-dashboard.weekly-planner.show', [
            'pageName' => 'Weekly Planner',
            'weekStart' => $weekStartDate,
            'weekEnd' => $weekEndDate,
            'days' => $days,
            'tasksByDay' => $tasksByDay,
            'itemsByDay' => $itemsByDay,
            'unscheduledTasks' => $unscheduledTasks,
            'activeRangeTasks' => $activeRangeTasks,
            'notes' => $plan?->notes,
            'prevWeek' => $weekStartDate->copy()->subWeek()->toDateString(),
            'nextWeek' => $weekStartDate->copy()->addWeek()->toDateString(),
            'quadrantCounts' => $quadrantCounts,
            'doneCount' => $doneCount,
            'openCount' => $openCount,
            'scheduledTaskCount' => $scheduledTasks->count(),
            'scheduledItemCount' => $scheduledItems->count(),
            'quadrantOptions' => TodoTask::quadrantOptions(),
            'categories' => $categories,
        ]);
    }

    public function schedule(ScheduleTaskRequest $request, TodoTaskService $service): RedirectResponse
    {
        $validated = $request->validated();
        $task = TodoTask::findOrFail($validated['todo_task_id']);

        if ($task->status === TodoTask::STATUS_ARCHIVED) {
            return redirect()->back()->with('error', 'Archived tasks cannot be scheduled.');
        }

        $date = Carbon::parse($validated['scheduled_date'], config('app.timezone', 'Africa/Cairo'));
        $service->schedule($task, $date);

        return redirect()
            ->back()
            ->with('success', 'Task scheduled successfully.');
    }

    public function unschedule(Request $request, TodoTaskService $service): RedirectResponse
    {
        $validated = $request->validate([
            'todo_task_id' => ['required', 'integer', 'exists:todo_tasks,id'],
        ]);

        $task = TodoTask::findOrFail($validated['todo_task_id']);
        $service->unschedule($task);

        return redirect()
            ->back()
            ->with('success', 'Task removed from schedule.');
    }

    public function saveNotes(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'week_start_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $timezone = config('app.timezone', 'Africa/Cairo');
        $weekStart = Carbon::parse($validated['week_start_date'], $timezone)->startOfDay();
        $weekEnd = $weekStart->copy()->addDays(6);

        WeeklyPlan::updateOrCreate([
            'week_start_date' => $weekStart->toDateString(),
        ], [
            'week_end_date' => $weekEnd->toDateString(),
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Weekly notes saved successfully.');
    }
}
