<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\System;
use App\Models\SystemBrand;
use App\Models\SystemKey;

    class SystemSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            System::factory()->count(3)->create()->each(function ($system1) {
                $this->createBrandsAndKeys($system1);
                $system1->children()->saveMany(System::factory()->count(random_int(3, 8))->create(['parent_system_id' => $system1->id])->each(function ($system2) use ($system1) {
                    $this->createBrandsAndKeys($system2);
                    $system2->children()->saveMany(System::factory()->count(random_int(3, 8))->create(['parent_system_id' => $system2->id])->each(function ($system3) use ($system2) {
                        $this->createBrandsAndKeys($system3);
                        $system3->children()->saveMany(System::factory()->count(random_int(3, 8))->create(['parent_system_id' => $system3->id]));
                    }));
                }));
            });
        }


        private function createBrandsAndKeys(System $system)
        {
            SystemBrand::factory()->count(random_int(1, 3))->create(['system_id' => $system->id]);
            SystemKey::factory()->count(random_int(1, 3))->create(['system_id' => $system->id]);
        }
    }
