<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'about';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('upload/about/' . $this->image);
        }
        return null;
    }
}
