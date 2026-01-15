<?php

namespace App\Services\PersonalDashboard;

use App\Models\TodoTask;
use Carbon\Carbon;

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
}
