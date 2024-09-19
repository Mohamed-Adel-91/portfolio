<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'email',
        'address',
        'phone',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'meta_title',
        'meta_description',
        'meta_tags',
        'cards',
        'transactions',
        'countries',
        'decades',
        'customers',
    ];
}
