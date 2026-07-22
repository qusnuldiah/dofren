<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            [
                'name'       => 'DoFren — Malang',
                'slug'       => 'malang',
                'address'    => 'Jl. Ciliwung II No. 28 C, Purwantoro, Kec. Blimbing, Kota Malang',
                'city'       => 'Malang',
                'phone'      => '021-5678-1234',
                'whatsapp'   => '08111234567',
                'open_hours' => '09:00 – 17:00',
                'is_open_now'=> true,
                'maps_embed' => 'https://maps.app.goo.gl/2JKvckuoG67HuCA79',
                'lat'        => -7.972498,
                'lng'        => 112.636651,
                'is_active'  => true,
            ],
        ];

        foreach ($branches as $b) {
            Branch::firstOrCreate(['slug' => $b['slug']], $b);
        }
    }
}
