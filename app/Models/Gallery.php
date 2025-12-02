<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $title
 * @property string|null $sub_title
 * @property string|null $image
 * @property string|null $iframe
 * @property-read string|null $image_path
 */
class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'iframe',
    ];

    public function getImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return 'upload/gallery/' . ltrim($this->image, '/');
    }
}
