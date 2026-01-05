<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtAccountLimitChange extends Model
{
    use HasFactory;

    protected $table = 'debt_account_limit_changes';

    protected $fillable = [
        'admin_id',
        'debt_account_id',
        'old_limit',
        'new_limit',
        'changed_at',
        'note',
    ];

    protected $casts = [
        'old_limit' => 'decimal:2',
        'new_limit' => 'decimal:2',
        'changed_at' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(DebtAccount::class, 'debt_account_id');
    }
}
