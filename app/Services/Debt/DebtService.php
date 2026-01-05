<?php

namespace App\Services\Debt;

use App\Models\DebtAccount;
use App\Models\DebtAccountLimitChange;
use App\Models\DebtTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DebtService
{
    public function getOrCreateAccountForAdmin(int $adminId, array $identity, array $attributes = []): DebtAccount
    {
        $identity['admin_id'] = $adminId;

        return DebtAccount::updateOrCreate($identity, array_merge($attributes, [
            'admin_id' => $adminId,
        ]));
    }

    public function addTransaction(DebtAccount $account, array $data): DebtTransaction
    {
        return DB::transaction(function () use ($account, $data) {
            $lockedAccount = DebtAccount::where('id', $account->id)->lockForUpdate()->firstOrFail();
            $amount = (float) $data['amount'];
            $bucket = $this->resolveBucket($data);

            if ($data['direction'] === 'increase') {
                if ($bucket === 'extra') {
                    $lockedAccount->extra_balance = (float) $lockedAccount->extra_balance + $amount;
                } else {
                    $lockedAccount->principal_balance = (float) $lockedAccount->principal_balance + $amount;
                }
            } else {
                if ($bucket === 'extra') {
                    $lockedAccount->extra_balance = max(0, (float) $lockedAccount->extra_balance - $amount);
                } else {
                    $lockedAccount->principal_balance = max(0, (float) $lockedAccount->principal_balance - $amount);
                }
            }

            $lockedAccount->current_balance = (float) $lockedAccount->principal_balance + (float) $lockedAccount->extra_balance;
            $lockedAccount->save();

            $transaction = $lockedAccount->transactions()->create([
                'admin_id' => $lockedAccount->admin_id,
                'type' => $data['type'],
                'direction' => $data['direction'],
                'bucket' => $bucket,
                'amount' => $amount,
                'transaction_date' => $data['transaction_date'],
                'note' => $data['note'] ?? null,
            ]);

            return $transaction;
        });
    }

    public function updateCreditLimit(DebtAccount $account, float $newLimit, ?string $note = null): DebtAccountLimitChange
    {
        return DB::transaction(function () use ($account, $newLimit, $note) {
            $lockedAccount = DebtAccount::where('id', $account->id)->lockForUpdate()->firstOrFail();

            $limitChange = $lockedAccount->limitChanges()->create([
                'admin_id' => $lockedAccount->admin_id,
                'old_limit' => $lockedAccount->credit_limit,
                'new_limit' => $newLimit,
                'changed_at' => Carbon::now(config('app.timezone')),
                'note' => $note,
            ]);

            $lockedAccount->credit_limit = $newLimit;
            $lockedAccount->save();

            return $limitChange;
        });
    }

    public function computeNextDueDate(DebtAccount $loan, Carbon $now): ?Carbon
    {
        if ($loan->type !== 'loan' || !$loan->installment_day) {
            return null;
        }

        $timezone = config('app.timezone');
        $today = $now->copy()->timezone($timezone)->startOfDay();
        $installmentDay = (int) $loan->installment_day;
        $startDate = $loan->start_date ? Carbon::parse($loan->start_date, $timezone)->startOfDay() : null;
        $endDate = $loan->end_date ? Carbon::parse($loan->end_date, $timezone)->startOfDay() : null;

        $candidate = $today->copy()->startOfMonth();
        $candidateDay = min($installmentDay, $candidate->daysInMonth);
        $candidate->day($candidateDay);

        if ($candidate->lt($today)) {
            $candidate = $candidate->addMonthNoOverflow()->startOfMonth();
            $candidateDay = min($installmentDay, $candidate->daysInMonth);
            $candidate->day($candidateDay);
        }

        if ($startDate && $candidate->lt($startDate)) {
            $candidate = $startDate->copy()->startOfMonth();
            $candidateDay = min($installmentDay, $candidate->daysInMonth);
            $candidate->day($candidateDay);

            if ($candidate->lt($startDate)) {
                $candidate = $candidate->addMonthNoOverflow()->startOfMonth();
                $candidateDay = min($installmentDay, $candidate->daysInMonth);
                $candidate->day($candidateDay);
            }
        }

        if ($endDate && $candidate->gt($endDate)) {
            return null;
        }

        return $candidate;
    }

    public function computeLoanInstallmentCount(DebtAccount $loan): int
    {
        if (
            $loan->type !== 'loan'
            || !$loan->installment_amount
            || !$loan->installment_day
            || !$loan->start_date
            || !$loan->end_date
        ) {
            return 0;
        }

        $timezone = config('app.timezone');
        $start = Carbon::parse($loan->start_date, $timezone)->startOfDay();
        $end = Carbon::parse($loan->end_date, $timezone)->startOfDay();

        if ($end->lt($start)) {
            return 0;
        }

        $installmentDay = (int) $loan->installment_day;
        $startAligned = $start->copy()->day(min($installmentDay, $start->daysInMonth));
        $endAligned = $end->copy()->day(min($installmentDay, $end->daysInMonth));

        $months = $startAligned->diffInMonths($endAligned);

        return max(1, $months);
    }

    public function computeLoanTotalPrincipal(DebtAccount $loan): float
    {
        $installments = $this->computeLoanInstallmentCount($loan);
        $installmentAmount = (float) $loan->installment_amount;

        return $installments * $installmentAmount;
    }

    public function computeLoanRemainingPrincipal(DebtAccount $loan): float
    {
        return (float) $loan->principal_balance;
    }

    public function refreshNextDueDatesForAdmin(int $adminId): void
    {
        $now = Carbon::now(config('app.timezone'));

        $query = DebtAccount::query()
            ->where('type', 'loan')
            ->where('admin_id', $adminId);

        $query->each(function (DebtAccount $loan) use ($now) {
            $nextDue = $this->computeNextDueDate($loan, $now);
            $loan->next_due_date = $nextDue ? $nextDue->toDateString() : null;
            $loan->save();
        });
    }

    private function resolveBucket(array $data): string
    {
        $type = $data['type'] ?? '';

        if (in_array($type, ['fee', 'interest'], true)) {
            return 'extra';
        }

        if ($type === 'adjustment' && isset($data['bucket']) && in_array($data['bucket'], ['principal', 'extra'], true)) {
            return $data['bucket'];
        }

        return 'principal';
    }
}
