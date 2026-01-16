<?php

namespace App\Http\Requests\Admin;

use App\Models\LifeGoalItem;
use App\Models\LifeGoalTransaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreLifeGoalTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('type')) {
            return;
        }

        if ($this->routeIs('admin.personal.life-goals.deposit')) {
            $this->merge(['type' => LifeGoalTransaction::TYPE_DEPOSIT]);
        } elseif ($this->routeIs('admin.personal.life-goals.withdraw')) {
            $this->merge(['type' => LifeGoalTransaction::TYPE_WITHDRAWAL]);
        }
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(array_keys(LifeGoalTransaction::typeOptions()))],
            'amount_egp' => ['required', 'numeric', 'min:0.01'],
            'note' => ['nullable', 'string', 'max:255'],
            'occurred_at' => ['required', 'date'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $type = $this->input('type');
            if ($type !== LifeGoalTransaction::TYPE_WITHDRAWAL) {
                return;
            }

            $item = $this->route('life_goal_item');
            if (! $item instanceof LifeGoalItem) {
                return;
            }

            if ($item->allow_overdraft) {
                return;
            }

            $amount = $this->decimalValue($this->input('amount_egp'));
            $saved = $item->saved_amount_egp;

            if ($this->compareDecimal($amount, $saved) === 1) {
                $validator->errors()->add('amount_egp', 'Withdrawal exceeds the saved balance for this goal.');
            }
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

    private function compareDecimal(string $left, string $right, int $scale = 2): int
    {
        if (function_exists('bccomp')) {
            return bccomp($left, $right, $scale);
        }

        return ((float) $left <=> (float) $right);
    }
}
