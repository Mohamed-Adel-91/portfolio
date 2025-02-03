<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    use HasFactory;

    protected $table = 'intro';

    protected $fillable = [
        'name',
        'title',
        'image',
        'cv_pdf',
    ];

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('upload/intro/' . $this->image);
        }
        return null;
    }
    public function getCvPdfPathAttribute()
    {
        if ($this->cv_pdf) {
            return asset('upload/cv/' . $this->cv_pdf);
        }
        return null;
    }
}
