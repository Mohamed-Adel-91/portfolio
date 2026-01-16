<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLifeGoalTransactionRequest;
use App\Models\LifeGoalItem;
use App\Models\LifeGoalTransaction;
use App\Services\PersonalDashboard\LifeGoals\LifeGoalTransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class LifeGoalTransactionController extends Controller
{
    public function index(LifeGoalItem $life_goal_item): View
    {
        $transactions = $life_goal_item->transactions()
            ->orderByDesc('occurred_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.personal-dashboard.life-goals.transactions', [
            'pageName' => 'Goal Transactions',
            'item' => $life_goal_item,
            'transactions' => $transactions,
        ]);
    }

    public function deposit(
        StoreLifeGoalTransactionRequest $request,
        LifeGoalItem $life_goal_item,
        LifeGoalTransactionService $service
    ): RedirectResponse {
        $validated = $request->validated();

        $service->deposit(
            $life_goal_item,
            (string) $validated['amount_egp'],
            $validated['note'] ?? null,
            $validated['occurred_at']
        );

        return redirect()
            ->back()
            ->with('success', 'Deposit added successfully.');
    }

    public function withdraw(
        StoreLifeGoalTransactionRequest $request,
        LifeGoalItem $life_goal_item,
        LifeGoalTransactionService $service
    ): RedirectResponse {
        $validated = $request->validated();

        try {
            $service->withdraw(
                $life_goal_item,
                (string) $validated['amount_egp'],
                $validated['note'] ?? null,
                $validated['occurred_at']
            );
        } catch (RuntimeException $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->back()
            ->with('success', 'Withdrawal recorded successfully.');
    }

    public function destroy(
        LifeGoalItem $life_goal_item,
        LifeGoalTransaction $transaction
    ): RedirectResponse {
        if ($transaction->life_goal_item_id !== $life_goal_item->id) {
            return redirect()
                ->back()
                ->with('error', 'Transaction not found for this goal.');
        }

        $transaction->delete();

        return redirect()
            ->back()
            ->with('success', 'Transaction deleted successfully.');
    }
}
