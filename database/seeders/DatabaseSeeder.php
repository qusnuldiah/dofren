<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminAndSettingSeeder::class,
            ImageProductSeeder::class,
            BranchSeeder::class,
            PromoSeeder::class,
        ]);
    }
}
