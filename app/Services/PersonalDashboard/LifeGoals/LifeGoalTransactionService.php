<?php

namespace App\Services\PersonalDashboard\LifeGoals;

use App\Models\LifeGoalItem;
use App\Models\LifeGoalTransaction;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class LifeGoalTransactionService
{
    public function deposit(LifeGoalItem $item, string $amount, ?string $note, string $occurredAt): LifeGoalTransaction
    {
        return $this->createTransaction($item, LifeGoalTransaction::TYPE_DEPOSIT, $amount, $note, $occurredAt);
    }

    public function withdraw(LifeGoalItem $item, string $amount, ?string $note, string $occurredAt): LifeGoalTransaction
    {
        if (! $item->allow_overdraft) {
            $saved = $this->getSavedAmount($item);
            if ($this->compareDecimal($amount, $saved) === 1) {
                throw new RuntimeException('Withdrawal exceeds saved balance.');
            }
        }

        return $this->createTransaction($item, LifeGoalTransaction::TYPE_WITHDRAWAL, $amount, $note, $occurredAt);
    }

    public function getSavedAmount(LifeGoalItem $item): string
    {
        $deposits = $this->decimalValue($item->deposits()->sum('amount_egp'));
        $withdrawals = $this->decimalValue($item->withdrawals()->sum('amount_egp'));

        return $this->decimalSub($deposits, $withdrawals);
    }

    private function createTransaction(
        LifeGoalItem $item,
        string $type,
        string $amount,
        ?string $note,
        string $occurredAt
    ): LifeGoalTransaction {
        return DB::transaction(function () use ($item, $type, $amount, $note, $occurredAt) {
            return LifeGoalTransaction::create([
                'life_goal_item_id' => $item->id,
                'type' => $type,
                'amount_egp' => $amount,
                'note' => $note,
                'occurred_at' => $occurredAt,
            ]);
        });
    }

    private function decimalValue($value, int $scale = 2): string
    {
        if ($value === null) {
            return '0.00';
        }

        if (is_string($value)) {
            return $value;
        }

        return number_format((float) $value, $scale, '.', '');
    }

    private function decimalSub(string $left, string $right, int $scale = 2): string
    {
        if (function_exists('bcsub')) {
            return bcsub($left, $right, $scale);
        }

        return number_format(((float) $left - (float) $right), $scale, '.', '');
    }

    private function compareDecimal(string $left, string $right, int $scale = 2): int
    {
        if (function_exists('bccomp')) {
            return bccomp($left, $right, $scale);
        }

        return ((float) $left <=> (float) $right);
    }
}
