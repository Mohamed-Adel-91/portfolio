<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SplitTodoTaskItemsRequest;
use App\Http\Requests\Admin\StoreTodoTaskRequest;
use App\Http\Requests\Admin\UpdateTodoTaskRequest;
use App\Models\TodoCategory;
use App\Models\TodoTask;
use App\Services\PersonalDashboard\TodoTaskService;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TodoTaskController extends Controller
{
    public function index(Request $request): View
    {
        $query = TodoTask::query()
            ->with('category')
            ->withCount('items');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('todo_category_id', $request->input('category'));
        }

        if ($request->filled('quadrant')) {
            $query->where('quadrant', $request->input('quadrant'));
        }

        if ($request->filled('stars_min')) {
            $query->where('stars', '>=', (int) $request->input('stars_min'));
        }

        if ($request->filled('due_from')) {
            $query->whereDate('due_date', '>=', $request->input('due_from'));
        }

        if ($request->filled('due_to')) {
            $query->whereDate('due_date', '<=', $request->input('due_to'));
        }

        if ($request->filled('scheduled')) {
            $scheduled = $request->input('scheduled');
            if ($scheduled === '1') {
                $query->whereNotNull('scheduled_date');
            } elseif ($scheduled === '0') {
                $query->whereNull('scheduled_date');
            }
        }

        if ($request->filled('has_range')) {
            $hasRange = $request->input('has_range');
            if ($hasRange === '1') {
                $query->whereNotNull('start_date')->whereNotNull('end_date');
            } elseif ($hasRange === '0') {
                $query->whereNull('start_date')->whereNull('end_date');
            }
        }

        if ($request->filled('range_active_today') && $request->input('range_active_today') === '1') {
            $today = Carbon::now(config('app.timezone'))->toDateString();
            $query->whereNotNull('start_date')
                ->whereNotNull('end_date')
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today);
        }

        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'due_date':
                $query->orderByRaw('due_date is null')->orderBy('due_date');
                break;
            case 'stars_desc':
                $query->orderByDesc('stars')->orderByDesc('id');
                break;
            case 'sort_order':
                $query->orderBy('sort_order')->orderBy('id');
                break;
            default:
                $query->orderByDesc('id');
                break;
        }

        $tasks = $query->paginate(20)->withQueryString();

        $categories = TodoCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.personal-dashboard.todo-tasks.index', [
            'pageName' => 'Todo Tasks',
            'tasks' => $tasks,
            'categories' => $categories,
            'statusOptions' => TodoTask::statusOptions(),
            'quadrantOptions' => TodoTask::quadrantOptions(),
            'filters' => $request->only([
                'search',
                'status',
                'category',
                'quadrant',
                'stars_min',
                'due_from',
                'due_to',
                'scheduled',
                'has_range',
                'range_active_today',
            ]),
            'sort' => $sort,
        ]);
    }

    public function create(): View
    {
        $categories = TodoCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.personal-dashboard.todo-tasks.create', [
            'pageName' => 'Add Task',
            'task' => new TodoTask(),
            'categories' => $categories,
            'statusOptions' => TodoTask::statusOptions(),
            'quadrantOptions' => TodoTask::quadrantOptions(),
        ]);
    }

    public function store(StoreTodoTaskRequest $request, TodoTaskService $service): RedirectResponse
    {
        $validated = $request->validated();
        $validated['status'] = $validated['status'] ?? TodoTask::STATUS_OPEN;
        $validated['quadrant'] = $validated['quadrant'] ?? TodoTask::QUADRANT_DO;
        $validated['stars'] = $validated['stars'] ?? 3;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($validated['status'] === TodoTask::STATUS_DONE) {
            $validated['completed_at'] = Carbon::now(config('app.timezone'));
        } else {
            $validated['completed_at'] = null;
        }

        $service->create($validated);

        $redirect = $request->boolean('redirect_back')
            ? redirect()->back()
            : redirect()->route('admin.personal.todo-tasks.index');

        return $redirect->with('success', 'Task created successfully.');
    }

    public function edit(TodoTask $todo_task): View
    {
        $categories = TodoCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $todo_task->load('items');

        return view('admin.personal-dashboard.todo-tasks.edit', [
            'pageName' => 'Edit Task',
            'task' => $todo_task,
            'categories' => $categories,
            'statusOptions' => TodoTask::statusOptions(),
            'quadrantOptions' => TodoTask::quadrantOptions(),
        ]);
    }

    public function update(
        UpdateTodoTaskRequest $request,
        TodoTask $todo_task,
        TodoTaskService $service
    ): RedirectResponse {
        $validated = $request->validated();

        if (array_key_exists('status', $validated)) {
            if ($validated['status'] === TodoTask::STATUS_DONE) {
                $validated['completed_at'] = Carbon::now(config('app.timezone'));
            } else {
                $validated['completed_at'] = null;
            }
        }

        $service->update($todo_task, $validated);

        return redirect()
            ->route('admin.personal.todo-tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(TodoTask $todo_task, TodoTaskService $service): RedirectResponse
    {
        $service->delete($todo_task);

        return redirect()
            ->route('admin.personal.todo-tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    public function markDone(TodoTask $todo_task, TodoTaskService $service): RedirectResponse
    {
        $service->markDone($todo_task);

        return redirect()
            ->back()
            ->with('success', 'Task marked as done.');
    }

    public function markOpen(TodoTask $todo_task, TodoTaskService $service): RedirectResponse
    {
        $service->markOpen($todo_task);

        return redirect()
            ->back()
            ->with('success', 'Task moved to open.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['nullable', 'integer', 'min:0'],
        ]);

        foreach ($validated['order'] as $taskId => $sortOrder) {
            TodoTask::whereKey($taskId)->update([
                'sort_order' => $sortOrder ?? 0,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Task order updated successfully.');
    }

    public function bulkUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'task_ids' => ['required', 'array'],
            'task_ids.*' => ['integer', 'exists:todo_tasks,id'],
            'bulk_action' => ['required', 'string', Rule::in([
                'mark_done',
                'mark_open',
                'set_quadrant',
                'set_category',
            ])],
            'bulk_quadrant' => ['nullable', 'string', Rule::in(array_keys(TodoTask::quadrantOptions()))],
            'bulk_category_id' => ['nullable', 'integer', 'exists:todo_categories,id'],
        ]);

        $taskIds = $validated['task_ids'];
        $action = $validated['bulk_action'];

        if ($action === 'set_quadrant' && empty($validated['bulk_quadrant'])) {
            return redirect()->back()->with('error', 'Please choose a quadrant for the bulk update.');
        }

        if ($action === 'set_category' && !array_key_exists('bulk_category_id', $validated)) {
            return redirect()->back()->with('error', 'Please choose a category for the bulk update.');
        }

        if ($action === 'mark_done') {
            TodoTask::whereIn('id', $taskIds)->update([
                'status' => TodoTask::STATUS_DONE,
                'completed_at' => Carbon::now(config('app.timezone')),
            ]);
        } elseif ($action === 'mark_open') {
            TodoTask::whereIn('id', $taskIds)->update([
                'status' => TodoTask::STATUS_OPEN,
                'completed_at' => null,
            ]);
        } elseif ($action === 'set_quadrant') {
            TodoTask::whereIn('id', $taskIds)->update([
                'quadrant' => $validated['bulk_quadrant'],
            ]);
        } elseif ($action === 'set_category') {
            TodoTask::whereIn('id', $taskIds)->update([
                'todo_category_id' => $validated['bulk_category_id'] ?? null,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Bulk action applied successfully.');
    }

    public function splitIntoItems(
        SplitTodoTaskItemsRequest $request,
        TodoTask $todo_task,
        TodoTaskService $service
    ): RedirectResponse {
        if (! $todo_task->hasRange()) {
            return redirect()
                ->back()
                ->with('error', 'Please set a start and end date before splitting.');
        }

        $created = $service->splitTaskIntoDailyItems(
            $todo_task,
            $todo_task->start_date,
            $todo_task->end_date,
            [
                'include_weekends' => $request->boolean('include_weekends', true),
                'title_prefix' => $request->input('title_prefix'),
            ]
        );

        if ($created === 0) {
            return redirect()
                ->back()
                ->with('info', 'All days already have items scheduled.');
        }

        return redirect()
            ->back()
            ->with('success', "Created {$created} daily items.");
    }
}
