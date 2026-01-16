<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeGoalTransaction extends Model
{
    use HasFactory;

    public const TYPE_DEPOSIT = 'deposit';
    public const TYPE_WITHDRAWAL = 'withdrawal';

    protected $table = 'life_goal_transactions';

    protected $fillable = [
        'life_goal_item_id',
        'type',
        'amount_egp',
        'note',
        'occurred_at',
    ];

    protected $casts = [
        'amount_egp' => 'decimal:2',
        'occurred_at' => 'date',
    ];

    public function item()
    {
        return $this->belongsTo(LifeGoalItem::class, 'life_goal_item_id');
    }

    public static function typeOptions(): array
    {
        return [
            self::TYPE_DEPOSIT => 'Deposit',
            self::TYPE_WITHDRAWAL => 'Withdrawal',
        ];
    }
}
