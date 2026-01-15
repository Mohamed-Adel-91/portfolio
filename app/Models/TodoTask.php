<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TodoTask extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'open';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_DONE = 'done';
    public const STATUS_ARCHIVED = 'archived';

    public const QUADRANT_DELETE = 'delete';
    public const QUADRANT_DELEGATE = 'delegate';
    public const QUADRANT_DEFER = 'defer';
    public const QUADRANT_DO = 'do';

    protected $table = 'todo_tasks';

    protected $fillable = [
        'title',
        'description',
        'todo_category_id',
        'status',
        'quadrant',
        'stars',
        'due_date',
        'scheduled_date',
        'sort_order',
        'completed_at',
    ];

    protected $casts = [
        'stars' => 'integer',
        'sort_order' => 'integer',
        'due_date' => 'date',
        'scheduled_date' => 'date',
        'completed_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(TodoCategory::class, 'todo_category_id');
    }

    public function isDone(): bool
    {
        return $this->status === self::STATUS_DONE;
    }

    public function markDone(): void
    {
        $this->status = self::STATUS_DONE;
        $this->completed_at = Carbon::now(config('app.timezone'));
        $this->save();
    }

    public function markOpen(): void
    {
        $this->status = self::STATUS_OPEN;
        $this->completed_at = null;
        $this->save();
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_OPEN => 'Open',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_DONE => 'Done',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }

    public static function quadrantOptions(): array
    {
        return [
            self::QUADRANT_DO => 'Do',
            self::QUADRANT_DEFER => 'Defer',
            self::QUADRANT_DELEGATE => 'Delegate',
            self::QUADRANT_DELETE => 'Delete',
        ];
    }
}
