<?php

namespace App\Models;

use App\Enums\SkillType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property string|null $progress
 * @property string|null $logo
 * @property-read string|null $logo_path
 */
class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $fillable = [
        'name',
        'type',
        'progress',
        'logo',
    ];

    protected $casts = [
        'type' => SkillType::class,
        'progress' => 'string',
    ];

    public function getLogoPathAttribute(): ?string
    {
        if (! $this->logo) {
            return null;
        }

        return 'upload/' . ltrim($this->logo, '/');
    }

    public static function typeOptions(): array
    {
        return collect(SkillType::cases())
            ->mapWithKeys(fn (SkillType $case) => [$case->value => $case->label()])
            ->all();
    }
}
