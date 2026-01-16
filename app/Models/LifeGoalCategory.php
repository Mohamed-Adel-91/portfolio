<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeGoalCategory extends Model
{
    use HasFactory;

    protected $table = 'life_goal_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(LifeGoalItem::class, 'life_goal_category_id')
            ->orderBy('sort_order')
            ->orderBy('title');
    }
}
