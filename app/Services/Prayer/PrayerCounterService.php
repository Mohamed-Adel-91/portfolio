<?php

namespace App\Services\Prayer;

use App\Models\PrayerCounter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrayerCounterService
{
    public function getOrCreateForAdmin(int $adminId): PrayerCounter
    {
        return PrayerCounter::firstOrCreate(
            ['admin_id' => $adminId],
            [
                'alfajr' => 0,
                'alzuhr' => 0,
                'alasr' => 0,
                'almaghrib' => 0,
                'aleisha' => 0,
            ]
        );
    }

    public function incrementDailyForAdmin(int $adminId, ?Carbon $now = null): PrayerCounter
    {
        $today = ($now ?: Carbon::now(config('app.timezone')))->toDateString();

        return DB::transaction(function () use ($adminId, $today) {
            $counter = PrayerCounter::where('admin_id', $adminId)->lockForUpdate()->first();

            if (!$counter) {
                $counter = PrayerCounter::create([
                    'admin_id' => $adminId,
                    'alfajr' => 0,
                    'alzuhr' => 0,
                    'alasr' => 0,
                    'almaghrib' => 0,
                    'aleisha' => 0,
                ]);
            }

            $lastIncremented = $counter->last_incremented_on
                ? $counter->last_incremented_on->toDateString()
                : null;

            if ($lastIncremented !== $today) {
                $counter->alfajr += 1;
                $counter->alzuhr += 1;
                $counter->alasr += 1;
                $counter->almaghrib += 1;
                $counter->aleisha += 1;
                $counter->last_incremented_on = $today;
                $counter->save();
            }

            return $counter->fresh();
        });
    }

    public function decrementPrayer(int $adminId, string $prayer): array
    {
        if (!in_array($prayer, PrayerCounter::PRAYERS, true)) {
            throw new \InvalidArgumentException('Invalid prayer.');
        }

        return DB::transaction(function () use ($adminId, $prayer) {
            $counter = PrayerCounter::where('admin_id', $adminId)->lockForUpdate()->first();

            if (!$counter) {
                $counter = PrayerCounter::create([
                    'admin_id' => $adminId,
                    'alfajr' => 0,
                    'alzuhr' => 0,
                    'alasr' => 0,
                    'almaghrib' => 0,
                    'aleisha' => 0,
                ]);
            }

            $decremented = false;

            if ($counter->$prayer > 0) {
                $counter->decrement($prayer);
                $decremented = true;
            }

            $counter->refresh();

            return [
                'counter' => $counter,
                'decremented' => $decremented,
            ];
        });
    }
}
