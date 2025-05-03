<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'co_name',
        'work_type',
        'title',
        'sub_title',
        'description',
        'image',
        'icon',
        'start_at',
        'end_at'
    ];

    protected $dates = ['start_at', 'end_at'];
}
