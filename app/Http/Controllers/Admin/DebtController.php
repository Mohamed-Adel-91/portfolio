<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DebtAccount;
use App\Services\Debt\DebtService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    public function index(DebtService $service)
    {
        $adminId = Auth::guard('admin')->id();
        $service->refreshNextDueDatesForAdmin($adminId);

        $accounts = DebtAccount::query()
            ->where('admin_id', $adminId)
            ->where('is_active', true)
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        $totalDebt = $accounts->sum(function (DebtAccount $account) {
            return (float) $account->total_balance;
        });

        $totalAvailableCredit = $accounts->where('type', 'revolving')->sum(function (DebtAccount $account) {
            return $account->available_credit ?? 0;
        });

        $totalLoanPrincipal = 0;
        $totalLoanRemaining = 0;

        $accounts->each(function (DebtAccount $account) use ($service, &$totalLoanPrincipal, &$totalLoanRemaining) {
            if ($account->type !== 'loan') {
                return;
            }

            $account->total_principal = $service->computeLoanTotalPrincipal($account);
            $account->remaining_principal = $service->computeLoanRemainingPrincipal($account);
            $totalLoanPrincipal += $account->total_principal;
            $totalLoanRemaining += $account->remaining_principal;
        });

        $now = Carbon::now(config('app.timezone'));
        $loansDueThisMonth = $accounts->where('type', 'loan')->filter(function (DebtAccount $account) use ($now) {
            if (!$account->next_due_date) {
                return false;
            }
            $dueDate = Carbon::parse($account->next_due_date, config('app.timezone'));
            return $dueDate->isSameMonth($now);
        });

        return view('admin.debts.index')->with([
            'pageName' => 'Debt & Credit Progress',
            'accounts' => $accounts,
            'totalDebt' => $totalDebt,
            'totalAvailableCredit' => $totalAvailableCredit,
            'loansDueThisMonth' => $loansDueThisMonth,
            'totalLoanPrincipal' => $totalLoanPrincipal,
            'totalLoanRemaining' => $totalLoanRemaining,
        ]);
    }

    public function show(DebtAccount $account, DebtService $service)
    {
        $this->authorizeAccount($account);

        $transactions = $account->transactions()
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->get();

        $limitChanges = $account->limitChanges()
            ->orderByDesc('changed_at')
            ->orderByDesc('id')
            ->get();

        $loanTotalPrincipal = null;
        $loanRemainingPrincipal = null;

        if ($account->type === 'loan') {
            $loanTotalPrincipal = $service->computeLoanTotalPrincipal($account);
            $loanRemainingPrincipal = $service->computeLoanRemainingPrincipal($account);
        }

        return view('admin.debts.show')->with([
            'pageName' => $account->name,
            'account' => $account,
            'transactions' => $transactions,
            'limitChanges' => $limitChanges,
            'loanTotalPrincipal' => $loanTotalPrincipal,
            'loanRemainingPrincipal' => $loanRemainingPrincipal,
        ]);
    }

    public function storeTransaction(Request $request, DebtService $service)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer|exists:debt_accounts,id',
            'amount' => 'required|numeric|min:0.01',
            'action_context' => 'required|in:payment,charge',
            'type' => 'required|in:payment,charge,interest,fee',
            'transaction_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $adminId = Auth::guard('admin')->id();
        $account = DebtAccount::query()
            ->where('id', $validated['account_id'])
            ->where('admin_id', $adminId)
            ->firstOrFail();

        if ($validated['action_context'] === 'payment') {
            if ($validated['type'] !== 'payment') {
                return response()->json([
                    'ok' => false,
                    'message' => 'Invalid payment type.',
                ], 422);
            }
            $validated['direction'] = 'decrease';
        } else {
            if (!in_array($validated['type'], ['charge', 'fee', 'interest'], true)) {
                return response()->json([
                    'ok' => false,
                    'message' => 'Invalid charge type.',
                ], 422);
            }
            $validated['direction'] = 'increase';
        }

        $service->addTransaction($account, $validated);

        $account->refresh();

        return response()->json([
            'ok' => true,
            'account' => $this->accountPayload($account),
            'message' => 'Transaction added.',
        ]);
    }

    public function updateLimit(Request $request, DebtAccount $account, DebtService $service)
    {
        $this->authorizeAccount($account);

        if ($account->type !== 'revolving') {
            return response()->json([
                'ok' => false,
                'message' => 'Credit limit updates are only for revolving accounts.',
            ], 422);
        }

        $validated = $request->validate([
            'new_limit' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $service->updateCreditLimit($account, (float) $validated['new_limit'], $validated['note'] ?? null);
        $account->refresh();

        return response()->json([
            'ok' => true,
            'account' => $this->accountPayload($account),
            'message' => 'Limit updated.',
        ]);
    }

    private function authorizeAccount(DebtAccount $account): void
    {
        $adminId = Auth::guard('admin')->id();
        if ($account->admin_id !== $adminId) {
            abort(403);
        }
    }

    private function accountPayload(DebtAccount $account): array
    {
        return [
            'id' => $account->id,
            'name' => $account->name,
            'type' => $account->type,
            'currency' => $account->currency,
            'total_balance' => (float) $account->total_balance,
            'principal_balance' => (float) $account->principal_balance,
            'extra_balance' => (float) $account->extra_balance,
            'credit_limit' => $account->credit_limit !== null ? (float) $account->credit_limit : null,
            'available_credit' => $account->available_credit !== null ? (float) $account->available_credit : null,
            'utilization_percent' => $account->utilization_percent,
        ];
    }
}
