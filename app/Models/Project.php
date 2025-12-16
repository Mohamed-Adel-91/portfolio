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
 * @property-read string|null $image_url
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

    public function portfolioItems()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function getImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return 'upload/projects/' . ltrim($this->image, '/');
    }

    public function getImageUrlAttribute(): ?string
    {
        $path = $this->image_path;

        return $path ? asset($path) : null;
    }
}
