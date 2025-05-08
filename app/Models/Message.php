<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];
    public function scopeUnread($query)
    {
        return $query->where('status', false);
    }
    public function scopeRead($query)
    {
        return $query->where('status', true);
    }
    public function scopeUnreadCount($query)
    {
        return $query->where('status', false)->count();
    }
    public function scopeReadCount($query)
    {
        return $query->where('status', true)->count();
    }
    public function scopeTotal($query)
    {
        return $query->count();
    }
    
}
