<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    protected $table = 'currency_rates';

    protected $fillable = [
        'code',
        'rate_to_egp',
        'is_active',
    ];

    protected $casts = [
        'rate_to_egp' => 'decimal:6',
        'is_active' => 'boolean',
    ];

    private static ?array $cachedRates = null;

    public static function getRate(string $code): ?string
    {
        $code = strtoupper($code);

        if (self::$cachedRates === null) {
            self::$cachedRates = self::query()
                ->where('is_active', true)
                ->pluck('rate_to_egp', 'code')
                ->map(function ($rate) {
                    return (string) $rate;
                })
                ->all();
        }

        return self::$cachedRates[$code] ?? null;
    }

    public static function convertFromEgp(string $amountEgp, string $code, int $scale = 2): ?string
    {
        $rate = self::getRate($code);
        if (! $rate) {
            return null;
        }

        if (self::isZero($rate, 6)) {
            return null;
        }

        if (function_exists('bcdiv')) {
            return bcdiv($amountEgp, $rate, $scale);
        }

        $value = (float) $amountEgp / (float) $rate;
        return number_format($value, $scale, '.', '');
    }

    public static function clearRateCache(): void
    {
        self::$cachedRates = null;
    }

    private static function isZero(string $value, int $scale = 6): bool
    {
        if (function_exists('bccomp')) {
            return bccomp($value, '0', $scale) === 0;
        }

        return abs((float) $value) < 0.000001;
    }
}
