<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $industry
 * @property string|null $location
 * @property string|null $logo
 * @property string|null $website
 * @property-read string|null $logo_path
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'industry',
        'location',
        'logo',
        'website',
    ];

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function getLogoPathAttribute(): ?string
    {
        if (! $this->logo) {
            return null;
        }

        return 'upload/' . ltrim($this->logo, '/');
    }
}
