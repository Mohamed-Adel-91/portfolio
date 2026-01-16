<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLifeGoalItemRequest;
use App\Http\Requests\Admin\UpdateLifeGoalItemRequest;
use App\Models\LifeGoalCategory;
use App\Models\LifeGoalItem;
use App\Models\LifeGoalTransaction;
use App\Services\PersonalDashboard\LifeGoals\CurrencyRateService;
use App\Services\PersonalDashboard\LifeGoals\LifeGoalItemService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LifeGoalItemController extends Controller
{
    public function index(Request $request, CurrencyRateService $currencyRateService): View
    {
        $categories = LifeGoalCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $itemsQuery = LifeGoalItem::query()
            ->with('category')
            ->withSum(['transactions as deposits_sum' => function ($query) {
                $query->where('type', LifeGoalTransaction::TYPE_DEPOSIT);
            }], 'amount_egp')
            ->withSum(['transactions as withdrawals_sum' => function ($query) {
                $query->where('type', LifeGoalTransaction::TYPE_WITHDRAWAL);
            }], 'amount_egp')
            ->orderBy('sort_order')
            ->orderBy('title');

        if ($request->filled('active')) {
            $itemsQuery->where('is_active', (bool) $request->input('active'));
        }

        $items = $itemsQuery->get();
        $itemsByCategory = $items->groupBy('life_goal_category_id');

        $rates = [
            'USD' => $currencyRateService->getRate('USD'),
            'SAR' => $currencyRateService->getRate('SAR'),
        ];

        return view('admin.personal-dashboard.life-goals.index', [
            'pageName' => 'Life Goals & Achievements',
            'categories' => $categories,
            'itemsByCategory' => $itemsByCategory,
            'filters' => $request->only(['active']),
            'rates' => $rates,
            'today' => Carbon::now(config('app.timezone'))->toDateString(),
        ]);
    }

    public function create(): View
    {
        $categories = LifeGoalCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.personal-dashboard.life-goals.create', [
            'pageName' => 'Add Goal Item',
            'item' => new LifeGoalItem(),
            'categories' => $categories,
        ]);
    }

    public function store(
        StoreLifeGoalItemRequest $request,
        LifeGoalItemService $service
    ): RedirectResponse {
        $data = $request->validated();
        $service->create($data, $request->file('image'));

        return redirect()
            ->route('admin.personal.life-goals.index')
            ->with('success', 'Goal item created successfully.');
    }

    public function edit(LifeGoalItem $life_goal_item): View
    {
        $categories = LifeGoalCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.personal-dashboard.life-goals.edit', [
            'pageName' => 'Edit Goal Item',
            'item' => $life_goal_item,
            'categories' => $categories,
        ]);
    }

    public function update(
        UpdateLifeGoalItemRequest $request,
        LifeGoalItem $life_goal_item,
        LifeGoalItemService $service
    ): RedirectResponse {
        $data = $request->validated();
        $service->update($life_goal_item, $data, $request->file('image'));

        return redirect()
            ->route('admin.personal.life-goals.index')
            ->with('success', 'Goal item updated successfully.');
    }

    public function destroy(
        LifeGoalItem $life_goal_item,
        LifeGoalItemService $service
    ): RedirectResponse {
        $service->delete($life_goal_item);

        return redirect()
            ->route('admin.personal.life-goals.index')
            ->with('success', 'Goal item deleted successfully.');
    }
}
