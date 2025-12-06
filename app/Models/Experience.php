<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $company_id
 * @property string|null $co_name
 * @property string|null $work_type
 * @property string|null $title
 * @property string|null $sub_title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property-read \App\Models\Company|null $company
 * @property-read string|null $image_path
 * @property-read string|null $logo_path
 */
class Experience extends Model
{
    use HasFactory;

    protected $table = 'experience';

    protected $fillable = [
        'company_id',
        'work_type',
        'title',
        'sub_title',
        'description',
        'image',
        'icon',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    protected $appends = [
        'co_name',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getImagePathAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return 'upload/' . ltrim($this->image, '/');
    }

    public function getLogoPathAttribute(): ?string
    {
        if ($this->company?->logo_path) {
            return $this->company->logo_path;
        }

        return $this->image_path;
    }

    public function getCoNameAttribute(): ?string
    {
        if ($this->relationLoaded('company') || array_key_exists('company_id', $this->attributes)) {
            return $this->company?->name;
        }

        if (array_key_exists('co_name', $this->attributes)) {
            return $this->attributes['co_name'];
        }

        return null;
    }
}
