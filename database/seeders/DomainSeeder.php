<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain;
use App\Enums\DomainStatuses;

class DomainSeeder extends Seeder
{
    public function run(): void
    {
        $domains = [
            ['name' => 'example.com', 'status' => DomainStatuses::ACTIVE->value],
            ['name' => 'testsite.org', 'status' => DomainStatuses::INACTIVE->value],
            ['name' => 'demo.net', 'status' => DomainStatuses::ACTIVE->value],
        ];

        foreach ($domains as $domain) {
            Domain::create($domain);
        }
    }
}
