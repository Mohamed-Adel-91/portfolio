<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $university_id
 * @property string|null $university_name
 * @property string|null $type
 * @property string|null $title
 * @property string|null $sub_title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property-read \App\Models\University|null $university
 * @property-read string|null $image_path
 */
class Education extends Model
{
    use HasFactory;

    protected $table = 'education';

    protected $fillable = [
        'university_id',
        'type',
        'title',
        'sub_title',
        'description',
        'image',
        'icon',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    protected $appends = [
        'university_name',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function getImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return 'upload/' . ltrim($this->image, '/');
    }

    public function getUniversityNameAttribute(): ?string
    {
        if ($this->relationLoaded('university') || array_key_exists('university_id', $this->attributes)) {
            return $this->university?->name;
        }

        if (array_key_exists('university_name', $this->attributes)) {
            return $this->attributes['university_name'];
        }

        return null;
    }
}
