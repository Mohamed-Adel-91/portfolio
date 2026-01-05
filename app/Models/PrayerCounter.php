<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerCounter extends Model
{
    use HasFactory;

    protected $table = 'prayer_counters';

    public const PRAYERS = [
        'alfajr',
        'alzuhr',
        'alasr',
        'almaghrib',
        'aleisha',
    ];

    protected $fillable = [
        'admin_id',
        'alfajr',
        'alzuhr',
        'alasr',
        'almaghrib',
        'aleisha',
        'last_incremented_on',
    ];

    protected $casts = [
        'last_incremented_on' => 'date',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
