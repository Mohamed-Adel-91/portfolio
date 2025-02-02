<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequestReplay extends Model
{
    use HasFactory;

    protected $table = 'contact_requests_replay';
    protected $fillable = [
        'contact_request_id',
        'reply_message',
    ];

    public function contactRequest()
    {
        return $this->belongsTo(ContactRequest::class);
    }
}
