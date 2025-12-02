<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $project_id
 * @property string|null $title
 * @property string|null $sub_title
 * @property string|null $image
 * @property-read string|null $image_path
 * @property-read Project $project
 */
class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolio';

    protected $fillable = [
        'project_id',
        'title',
        'sub_title',
        'image',
    ];

    protected $casts = [
        'project_id' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return 'upload/portfolio/' . ltrim($this->image, '/');
    }
}
