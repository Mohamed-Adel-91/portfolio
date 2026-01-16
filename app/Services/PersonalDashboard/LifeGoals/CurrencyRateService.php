<?php

namespace App\Services\PersonalDashboard\LifeGoals;

use App\Models\CurrencyRate;
use Illuminate\Support\Facades\DB;

class CurrencyRateService
{
    public function getRate(string $code): ?string
    {
        return CurrencyRate::getRate($code);
    }

    public function convertEgpTo(string $amountEgp, string $code, int $scale = 2): ?string
    {
        return CurrencyRate::convertFromEgp($amountEgp, $code, $scale);
    }

    public function updateRates(array $rates): void
    {
        DB::transaction(function () use ($rates) {
            foreach ($rates as $code => $payload) {
                $normalizedCode = strtoupper($code);
                $rateValue = $payload['rate_to_egp'] ?? null;
                $isActive = array_key_exists('is_active', $payload)
                    ? (bool) $payload['is_active']
                    : true;

                if ($rateValue === null || $rateValue === '') {
                    continue;
                }

                CurrencyRate::updateOrCreate(
                    ['code' => $normalizedCode],
                    [
                        'rate_to_egp' => $rateValue,
                        'is_active' => $isActive,
                    ]
                );
            }
        });

        CurrencyRate::clearRateCache();
    }
}
