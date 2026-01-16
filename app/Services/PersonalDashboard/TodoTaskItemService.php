<?php

namespace App\Services\PersonalDashboard;

use App\Models\TodoTask;
use App\Models\TodoTaskItem;
use Illuminate\Support\Carbon;

class TodoTaskItemService
{
    public function create(TodoTask $task, array $data): TodoTaskItem
    {
        $data['status'] = $data['status'] ?? TodoTaskItem::STATUS_OPEN;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['todo_task_id'] = $task->id;

        if ($data['status'] === TodoTaskItem::STATUS_DONE) {
            $data['completed_at'] = Carbon::now(config('app.timezone'));
        } else {
            $data['completed_at'] = null;
        }

        return TodoTaskItem::create($data);
    }

    public function update(TodoTaskItem $item, array $data): TodoTaskItem
    {
        if (array_key_exists('status', $data)) {
            if ($data['status'] === TodoTaskItem::STATUS_DONE) {
                $data['completed_at'] = Carbon::now(config('app.timezone'));
            } else {
                $data['completed_at'] = null;
            }
        }

        $item->update($data);

        return $item;
    }

    public function delete(TodoTaskItem $item): void
    {
        $item->delete();
    }

    public function schedule(TodoTaskItem $item, ?Carbon $date): TodoTaskItem
    {
        $item->scheduled_date = $date?->toDateString();
        $item->save();

        return $item;
    }

    public function markDone(TodoTaskItem $item): TodoTaskItem
    {
        $item->status = TodoTaskItem::STATUS_DONE;
        $item->completed_at = Carbon::now(config('app.timezone'));
        $item->save();

        return $item;
    }

    public function markOpen(TodoTaskItem $item): TodoTaskItem
    {
        $item->status = TodoTaskItem::STATUS_OPEN;
        $item->completed_at = null;
        $item->save();

        return $item;
    }

    public function reorder(TodoTask $task, array $orderMap): void
    {
        foreach ($orderMap as $itemId => $sortOrder) {
            TodoTaskItem::where('todo_task_id', $task->id)
                ->where('id', $itemId)
                ->update(['sort_order' => $sortOrder ?? 0]);
        }
    }
}
