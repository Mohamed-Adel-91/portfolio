<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $country
 * @property string|null $city
 * @property string|null $logo
 * @property string|null $website
 * @property-read string|null $logo_path
 */
class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'city',
        'logo',
        'website',
    ];

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function getLogoPathAttribute(): ?string
    {
        if (! $this->logo) {
            return null;
        }

        return 'upload/' . ltrim($this->logo, '/');
    }
}
