<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $image
 * @property string|null $url
 * @property \Illuminate\Support\Carbon|null $lunched_at
 * @property-read string|null $image_path
 */
class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'image',
        'url',
        'lunched_at',
    ];

    protected $casts = [
        'lunched_at' => 'date',
    ];

    public function getImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return 'upload/projects/' . ltrim($this->image, '/');
    }
}
