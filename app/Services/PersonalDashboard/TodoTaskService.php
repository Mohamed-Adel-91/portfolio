<?php

namespace App\Services\PersonalDashboard;

use App\Models\TodoTask;
use App\Models\TodoTaskItem;
use Illuminate\Support\Carbon;

class TodoTaskService
{
    public function create(array $data): TodoTask
    {
        $data['status'] = $data['status'] ?? TodoTask::STATUS_OPEN;
        $data['quadrant'] = $data['quadrant'] ?? TodoTask::QUADRANT_DO;
        $data['stars'] = $data['stars'] ?? 3;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return TodoTask::create($data);
    }

    public function update(TodoTask $task, array $data): TodoTask
    {
        $task->update($data);

        return $task;
    }

    public function delete(TodoTask $task): void
    {
        $task->delete();
    }

    public function markDone(TodoTask $task): TodoTask
    {
        $task->status = TodoTask::STATUS_DONE;
        $task->completed_at = Carbon::now(config('app.timezone'));
        $task->save();

        return $task;
    }

    public function markOpen(TodoTask $task): TodoTask
    {
        $task->status = TodoTask::STATUS_OPEN;
        $task->completed_at = null;
        $task->save();

        return $task;
    }

    public function schedule(TodoTask $task, Carbon $date): TodoTask
    {
        $task->scheduled_date = $date->toDateString();
        $task->save();

        return $task;
    }

    public function unschedule(TodoTask $task): TodoTask
    {
        $task->scheduled_date = null;
        $task->save();

        return $task;
    }

    public function splitTaskIntoDailyItems(
        TodoTask $task,
        Carbon $start,
        Carbon $end,
        array $options = []
    ): int {
        $includeWeekends = $options['include_weekends'] ?? true;
        $titlePrefix = $options['title_prefix'] ?? null;

        $existingDates = $task->items()
            ->whereNotNull('scheduled_date')
            ->pluck('scheduled_date')
            ->map(fn ($date) => Carbon::parse($date)->toDateString())
            ->all();

        $existingLookup = array_fill_keys($existingDates, true);
        $current = $start->copy()->startOfDay();
        $endDate = $end->copy()->startOfDay();
        $created = 0;
        $dayNumber = 1;
        $nextSort = (int) $task->items()->max('sort_order');

        while ($current->lte($endDate)) {
            $isWeekend = in_array($current->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY], true);

            if ($includeWeekends || ! $isWeekend) {
                $dateKey = $current->toDateString();
                if (! isset($existingLookup[$dateKey])) {
                    $title = $titlePrefix
                        ? trim($titlePrefix . ' ' . $task->title)
                        : '(Day ' . $dayNumber . ') ' . $task->title;

                    $nextSort++;
                    TodoTaskItem::create([
                        'todo_task_id' => $task->id,
                        'title' => $title,
                        'status' => TodoTaskItem::STATUS_OPEN,
                        'scheduled_date' => $dateKey,
                        'sort_order' => $nextSort,
                    ]);

                    $existingLookup[$dateKey] = true;
                    $created++;
                }

                $dayNumber++;
            }

            $current->addDay();
        }

        return $created;
    }
}
