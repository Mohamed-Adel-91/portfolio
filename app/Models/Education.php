<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $university_name
 * @property string|null $type
 * @property string|null $title
 * @property string|null $sub_title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property-read string|null $image_path
 */
class Education extends Model
{
    use HasFactory;

    protected $table = 'education';

    protected $fillable = [
        'university_name',
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

    public function getImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return 'upload/' . ltrim($this->image, '/');
    }
}
