<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Services\Prayer\PrayerCounterService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PrayerCountersDailyIncrement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prayers:increment-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment prayer counters once per day for each admin.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PrayerCounterService $service)
    {
        $today = Carbon::now(config('app.timezone'));
        $admins = Admin::query()->select('id')->get();

        if ($admins->isEmpty()) {
            $this->info('No admins found.');
            return Command::SUCCESS;
        }

        foreach ($admins as $admin) {
            $service->incrementDailyForAdmin($admin->id, $today);
        }

        $this->info('Prayer counters incremented.');

        return Command::SUCCESS;
    }
}
