<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeGoalItem extends Model
{
    use HasFactory;

    protected $table = 'life_goal_items';

    protected $fillable = [
        'life_goal_category_id',
        'title',
        'description',
        'image_path',
        'target_amount_egp',
        'allow_overdraft',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'target_amount_egp' => 'decimal:2',
        'allow_overdraft' => 'boolean',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(LifeGoalCategory::class, 'life_goal_category_id');
    }

    public function transactions()
    {
        return $this->hasMany(LifeGoalTransaction::class, 'life_goal_item_id');
    }

    public function deposits()
    {
        return $this->transactions()->where('type', LifeGoalTransaction::TYPE_DEPOSIT);
    }

    public function withdrawals()
    {
        return $this->transactions()->where('type', LifeGoalTransaction::TYPE_WITHDRAWAL);
    }

    public function getSavedAmountEgpAttribute(): string
    {
        $deposits = $this->sumAttributeValue('deposits_sum', function () {
            return $this->deposits()->sum('amount_egp');
        });
        $withdrawals = $this->sumAttributeValue('withdrawals_sum', function () {
            return $this->withdrawals()->sum('amount_egp');
        });

        return $this->decimalSub($deposits, $withdrawals);
    }

    public function getProgressPercentAttribute(): float
    {
        $target = $this->decimalValue($this->target_amount_egp);
        if ($this->isZero($target)) {
            return 0.0;
        }

        $saved = $this->saved_amount_egp;
        if (function_exists('bcdiv') && function_exists('bcmul')) {
            $ratio = bcdiv($saved, $target, 4);
            $percent = (float) bcmul($ratio, '100', 2);
        } else {
            $percent = ((float) $saved / (float) $target) * 100;
        }

        if ($percent < 0) {
            return 0.0;
        }

        return $percent > 100 ? 100.0 : round($percent, 2);
    }

    public function getRemainingEgpAttribute(): string
    {
        $target = $this->decimalValue($this->target_amount_egp);
        $saved = $this->saved_amount_egp;

        if ($this->isGreaterOrEqual($saved, $target)) {
            return '0.00';
        }

        return $this->decimalSub($target, $saved);
    }

    public function getTargetAmountUsdAttribute(): ?string
    {
        return CurrencyRate::convertFromEgp($this->decimalValue($this->target_amount_egp), 'USD', 2);
    }

    public function getTargetAmountSarAttribute(): ?string
    {
        return CurrencyRate::convertFromEgp($this->decimalValue($this->target_amount_egp), 'SAR', 2);
    }

    private function sumAttributeValue(string $key, callable $fallback): string
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->decimalValue($this->attributes[$key]);
        }

        return $this->decimalValue($fallback());
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

    private function isZero(string $value, int $scale = 2): bool
    {
        if (function_exists('bccomp')) {
            return bccomp($value, '0', $scale) === 0;
        }

        return abs((float) $value) < 0.000001;
    }

    private function isGreaterOrEqual(string $left, string $right, int $scale = 2): bool
    {
        if (function_exists('bccomp')) {
            return bccomp($left, $right, $scale) >= 0;
        }

        return (float) $left >= (float) $right;
    }
}
