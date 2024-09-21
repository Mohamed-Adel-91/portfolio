<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['full_name', 'role', 'email', 'mobile', 'country', 'website', 'details'];
}
