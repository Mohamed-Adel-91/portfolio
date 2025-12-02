<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $head_title
 * @property string|null $title
 * @property string|null $sub_title
 */
class Resume extends Model
{
    use HasFactory;

    protected $table = 'resume';

    protected $fillable = [
        'head_title',
        'title',
        'sub_title',
    ];
}
