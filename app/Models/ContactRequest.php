<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $table = 'contact_requests';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'message',
        'reply_status',
    ];

    public function replays()
    {
        return $this->hasMany(ContactRequestReplay::class);
    }
}
