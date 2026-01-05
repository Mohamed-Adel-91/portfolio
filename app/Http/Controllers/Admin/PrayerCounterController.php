<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrayerCounter;
use App\Services\Prayer\PrayerCounterService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PrayerCounterController extends Controller
{
    public function index(PrayerCounterService $service)
    {
        $adminId = Auth::guard('admin')->id();
        $counter = $service->incrementDailyForAdmin($adminId);

        return view('admin.prayers.index')->with([
            'pageName' => 'Prayer Counters',
            'prayers' => $this->prayerLabels(),
            'counters' => Arr::only($counter->toArray(), PrayerCounter::PRAYERS),
        ]);
    }

    public function done(PrayerCounterService $service, string $prayer)
    {
        $prayer = strtolower($prayer);

        if (!in_array($prayer, PrayerCounter::PRAYERS, true)) {
            return response()->json([
                'ok' => false,
                'message' => 'Invalid prayer.',
            ], 422);
        }

        $adminId = Auth::guard('admin')->id();
        $service->incrementDailyForAdmin($adminId);

        try {
            $result = $service->decrementPrayer($adminId, $prayer);
            $counter = $result['counter'];
            $decremented = $result['decremented'];

            return response()->json([
                'ok' => true,
                'decremented' => $decremented,
                'counters' => Arr::only($counter->toArray(), PrayerCounter::PRAYERS),
                'message' => $decremented ? 'Decremented.' : 'Nothing to decrement.',
            ]);
        } catch (\Throwable $exception) {
            Log::error('Prayer counter decrement failed', [
                'admin_id' => $adminId,
                'prayer' => $prayer,
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'ok' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    private function prayerLabels(): array
    {
        return [
            'alfajr' => ['label' => 'Fajr'],
            'alzuhr' => ['label' => 'Dhuhr'],
            'alasr' => ['label' => 'Asr'],
            'almaghrib' => ['label' => 'Maghrib'],
            'aleisha' => ['label' => 'Isha'],
        ];
    }
}
