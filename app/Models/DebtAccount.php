<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtAccount extends Model
{
    use HasFactory;

    protected $table = 'debt_accounts';

    protected $fillable = [
        'admin_id',
        'name',
        'provider',
        'type',
        'currency',
        'current_balance',
        'principal_balance',
        'extra_balance',
        'credit_limit',
        'installment_amount',
        'installment_day',
        'start_date',
        'end_date',
        'next_due_date',
        'is_active',
    ];

    protected $casts = [
        'current_balance' => 'decimal:2',
        'principal_balance' => 'decimal:2',
        'extra_balance' => 'decimal:2',
        'credit_limit' => 'decimal:2',
        'installment_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'next_due_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function transactions()
    {
        return $this->hasMany(DebtTransaction::class);
    }

    public function limitChanges()
    {
        return $this->hasMany(DebtAccountLimitChange::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getTotalBalanceAttribute()
    {
        return (float) $this->principal_balance + (float) $this->extra_balance;
    }

    public function getAvailableCreditAttribute()
    {
        if ($this->credit_limit === null) {
            return null;
        }

        return max(0, (float) $this->credit_limit - (float) $this->total_balance);
    }

    public function getUtilizationPercentAttribute()
    {
        if ($this->credit_limit === null || (float) $this->credit_limit <= 0) {
            return null;
        }

        return round(((float) $this->total_balance / (float) $this->credit_limit) * 100, 2);
    }
}
