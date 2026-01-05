<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtTransaction extends Model
{
    use HasFactory;

    protected $table = 'debt_transactions';

    protected $fillable = [
        'admin_id',
        'debt_account_id',
        'type',
        'direction',
        'bucket',
        'amount',
        'transaction_date',
        'note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    public function account()
    {
        return $this->belongsTo(DebtAccount::class, 'debt_account_id');
    }
}
