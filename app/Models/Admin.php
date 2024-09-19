<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile',
        'profile_picture'
    ];

    public function setPasswordAttribute(String $input): void{
        $this->attributes['password'] = Hash::make($input);
    }

}
