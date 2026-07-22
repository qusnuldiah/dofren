<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminAndSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Admin::create([
            'name' => 'Admin',
            'email' => 'admin@dofren.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        ]);

        \App\Models\Setting::insert([
            ['key' => 'link_gofood', 'value' => 'https://gofood.co.id/dofren'],
            ['key' => 'link_grabfood', 'value' => 'https://food.grab.com/dofren'],
            ['key' => 'link_shopeefood', 'value' => 'https://shopeefood.co.id/dofren'],
        ]);
    }
}
