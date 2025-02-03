<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'slogan', 'address', 'phone1', 'phone2', 'whats_up',
        'facebook', 'messenger', 'twitter', 'instagram', 'youtube', 'linkedin', 'github',
        'meta_title', 'meta_description', 'meta_tags', 'customers'
    ];
}
