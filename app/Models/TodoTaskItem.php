<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TodoTaskItem extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'open';
    public const STATUS_DONE = 'done';

    protected $table = 'todo_task_items';

    protected $fillable = [
        'todo_task_id',
        'title',
        'description',
        'status',
        'scheduled_date',
        'sort_order',
        'completed_at',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'sort_order' => 'integer',
        'completed_at' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(TodoTask::class, 'todo_task_id');
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
            self::STATUS_DONE => 'Done',
        ];
    }
}
