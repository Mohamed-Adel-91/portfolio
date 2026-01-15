<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoCategory extends Model
{
    use HasFactory;

    protected $table = 'todo_categories';

    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function tasks()
    {
        return $this->hasMany(TodoTask::class, 'todo_category_id');
    }

    public function getBadgeColorAttribute(): string
    {
        if ($this->color) {
            return $this->color;
        }

        $palette = [
            '#0d6efd',
            '#198754',
            '#dc3545',
            '#6f42c1',
            '#fd7e14',
            '#20c997',
            '#0dcaf0',
            '#6c757d',
        ];

        $seed = $this->id ?? crc32((string) $this->name);
        $index = abs((int) $seed) % count($palette);

        return $palette[$index];
    }
}
