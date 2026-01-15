<?php

namespace Database\Seeders;

use App\Models\TodoCategory;
use Illuminate\Database\Seeder;

class TodoCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tech Work', 'slug' => 'tech_work', 'color' => '#0d6efd', 'sort_order' => 1],
            ['name' => 'PPO Work', 'slug' => 'ppo_work', 'color' => '#e90dfd', 'sort_order' => 2],
            ['name' => 'Personal', 'slug' => 'personal', 'color' => '#198754', 'sort_order' => 3],
            ['name' => 'Learning', 'slug' => 'learning', 'color' => '#6f42c1', 'sort_order' => 4],
            ['name' => 'Health', 'slug' => 'health', 'color' => '#dc3545', 'sort_order' => 5],
            ['name' => 'Finance', 'slug' => 'finance', 'color' => '#fd7e14', 'sort_order' => 6],
        ];

        foreach ($categories as $data) {
            TodoCategory::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['is_active' => true])
            );
        }
    }
}
