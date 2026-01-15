<?php

namespace App\Http\Controllers\Admin\PersonalDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTodoCategoryRequest;
use App\Http\Requests\Admin\UpdateTodoCategoryRequest;
use App\Models\TodoCategory;
use App\Services\PersonalDashboard\TodoCategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodoCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = TodoCategory::query()->withCount('tasks');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('active')) {
            $active = $request->input('active');
            $query->where('is_active', (bool) $active);
        }

        $categories = $query
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.personal-dashboard.todo-categories.index', [
            'pageName' => 'Todo Categories',
            'categories' => $categories,
            'filters' => $request->only(['search', 'active']),
        ]);
    }

    public function create(): View
    {
        return view('admin.personal-dashboard.todo-categories.create', [
            'pageName' => 'Add Category',
            'category' => new TodoCategory(),
        ]);
    }

    public function store(StoreTodoCategoryRequest $request, TodoCategoryService $service): RedirectResponse
    {
        $validated = $request->validated();

        $service->create($validated);

        return redirect()
            ->route('admin.personal.todo-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(TodoCategory $todo_category): View
    {
        return view('admin.personal-dashboard.todo-categories.edit', [
            'pageName' => 'Edit Category',
            'category' => $todo_category,
        ]);
    }

    public function update(
        UpdateTodoCategoryRequest $request,
        TodoCategory $todo_category,
        TodoCategoryService $service
    ): RedirectResponse {
        $validated = $request->validated();

        $service->update($todo_category, $validated);

        return redirect()
            ->route('admin.personal.todo-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(TodoCategory $todo_category, TodoCategoryService $service): RedirectResponse
    {
        $service->delete($todo_category);

        return redirect()
            ->route('admin.personal.todo-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
