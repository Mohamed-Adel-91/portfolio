<?php

namespace App\Http\Controllers\Admin\PersonalDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReorderTodoTaskItemsRequest;
use App\Http\Requests\Admin\ScheduleTaskItemRequest;
use App\Http\Requests\Admin\StoreTodoTaskItemRequest;
use App\Http\Requests\Admin\UnscheduleTaskItemRequest;
use App\Http\Requests\Admin\UpdateTodoTaskItemRequest;
use App\Models\TodoTask;
use App\Models\TodoTaskItem;
use App\Services\PersonalDashboard\TodoTaskItemService;
use Illuminate\Support\Carbon;
use Illuminate\Http\RedirectResponse;

class TodoTaskItemController extends Controller
{
    public function store(
        StoreTodoTaskItemRequest $request,
        TodoTask $todo_task,
        TodoTaskItemService $service
    ): RedirectResponse {
        $validated = $request->validated();

        if ((int) $validated['todo_task_id'] !== (int) $todo_task->id) {
            return redirect()->back()->with('error', 'Task item could not be created.');
        }

        $service->create($todo_task, $validated);

        return redirect()
            ->back()
            ->with('success', 'Task item added successfully.');
    }

    public function update(
        UpdateTodoTaskItemRequest $request,
        TodoTask $todo_task,
        TodoTaskItem $item,
        TodoTaskItemService $service
    ): RedirectResponse {
        if ($item->todo_task_id !== $todo_task->id) {
            return redirect()->back()->with('error', 'Task item not found.');
        }

        $service->update($item, $request->validated());

        return redirect()
            ->back()
            ->with('success', 'Task item updated successfully.');
    }

    public function destroy(
        TodoTask $todo_task,
        TodoTaskItem $item,
        TodoTaskItemService $service
    ): RedirectResponse {
        if ($item->todo_task_id !== $todo_task->id) {
            return redirect()->back()->with('error', 'Task item not found.');
        }

        $service->delete($item);

        return redirect()
            ->back()
            ->with('success', 'Task item deleted successfully.');
    }

    public function markDone(
        TodoTask $todo_task,
        TodoTaskItem $item,
        TodoTaskItemService $service
    ): RedirectResponse {
        if ($item->todo_task_id !== $todo_task->id) {
            return redirect()->back()->with('error', 'Task item not found.');
        }

        $service->markDone($item);

        return redirect()
            ->back()
            ->with('success', 'Task item marked as done.');
    }

    public function markOpen(
        TodoTask $todo_task,
        TodoTaskItem $item,
        TodoTaskItemService $service
    ): RedirectResponse {
        if ($item->todo_task_id !== $todo_task->id) {
            return redirect()->back()->with('error', 'Task item not found.');
        }

        $service->markOpen($item);

        return redirect()
            ->back()
            ->with('success', 'Task item moved to open.');
    }

    public function schedule(
        ScheduleTaskItemRequest $request,
        TodoTask $todo_task,
        TodoTaskItem $item,
        TodoTaskItemService $service
    ): RedirectResponse {
        if ($item->todo_task_id !== $todo_task->id) {
            return redirect()->back()->with('error', 'Task item not found.');
        }

        $validated = $request->validated();
        $date = Carbon::parse($validated['scheduled_date'], config('app.timezone', 'Africa/Cairo'));
        $service->schedule($item, $date);

        return redirect()
            ->back()
            ->with('success', 'Task item scheduled successfully.');
    }

    public function unschedule(
        UnscheduleTaskItemRequest $request,
        TodoTask $todo_task,
        TodoTaskItem $item,
        TodoTaskItemService $service
    ): RedirectResponse {
        if ($item->todo_task_id !== $todo_task->id) {
            return redirect()->back()->with('error', 'Task item not found.');
        }

        $request->validated();
        $service->schedule($item, null);

        return redirect()
            ->back()
            ->with('success', 'Task item removed from schedule.');
    }

    public function reorder(
        ReorderTodoTaskItemsRequest $request,
        TodoTask $todo_task,
        TodoTaskItemService $service
    ): RedirectResponse {
        $service->reorder($todo_task, $request->validated()['order']);

        return redirect()
            ->back()
            ->with('success', 'Task item order updated successfully.');
    }
}
