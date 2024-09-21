<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\System;
use App\Models\User;
use App\Models\UserSystem;

class UserSystemSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 8; $i++) {
                $this->assignRandomSystemsToUser($user->id);
            }
        }
    }

    private function assignRandomSystemsToUser($userId)
    {
        $mainSystem = System::whereNull('parent_system_id')->inRandomOrder()->first();

        if (!$mainSystem) {
            return;
        }

        $system1 = $mainSystem->descendants()->inRandomOrder()->first();
        $system2 = $system1 ? $system1->descendants()->inRandomOrder()->first() : null;
        $system3 = $system2 ? $system2->descendants()->inRandomOrder()->first() : null;

        UserSystem::create([
            'user_id' => $userId,
            'main_system_id' => $mainSystem->id,
            'system1_id' => $system1 ? $system1->id : null,
            'system2_id' => $system2 ? $system2->id : null,
            'system3_id' => $system3 ? $system3->id : null,
        ]);
    }
}
