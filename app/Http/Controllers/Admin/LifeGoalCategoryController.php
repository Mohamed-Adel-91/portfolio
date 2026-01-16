<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLifeGoalCategoryRequest;
use App\Http\Requests\Admin\UpdateLifeGoalCategoryRequest;
use App\Models\LifeGoalCategory;
use App\Services\PersonalDashboard\LifeGoals\LifeGoalCategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LifeGoalCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = LifeGoalCategory::query()->withCount('items');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('active')) {
            $query->where('is_active', (bool) $request->input('active'));
        }

        $categories = $query
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.personal-dashboard.life-goal-categories.index', [
            'pageName' => 'Life Goal Categories',
            'categories' => $categories,
            'filters' => $request->only(['search', 'active']),
        ]);
    }

    public function create(): View
    {
        return view('admin.personal-dashboard.life-goal-categories.create', [
            'pageName' => 'Add Goal Category',
            'category' => new LifeGoalCategory(),
        ]);
    }

    public function store(
        StoreLifeGoalCategoryRequest $request,
        LifeGoalCategoryService $service
    ): RedirectResponse {
        $service->create($request->validated());

        return redirect()
            ->route('admin.personal.life-goal-categories.index')
            ->with('success', 'Goal category created successfully.');
    }

    public function edit(LifeGoalCategory $life_goal_category): View
    {
        return view('admin.personal-dashboard.life-goal-categories.edit', [
            'pageName' => 'Edit Goal Category',
            'category' => $life_goal_category,
        ]);
    }

    public function update(
        UpdateLifeGoalCategoryRequest $request,
        LifeGoalCategory $life_goal_category,
        LifeGoalCategoryService $service
    ): RedirectResponse {
        $service->update($life_goal_category, $request->validated());

        return redirect()
            ->route('admin.personal.life-goal-categories.index')
            ->with('success', 'Goal category updated successfully.');
    }

    public function destroy(
        LifeGoalCategory $life_goal_category,
        LifeGoalCategoryService $service
    ): RedirectResponse {
        $service->delete($life_goal_category);

        return redirect()
            ->route('admin.personal.life-goal-categories.index')
            ->with('success', 'Goal category deleted successfully.');
    }
}
