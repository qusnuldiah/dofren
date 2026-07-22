<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'platform'       => 'GoFood',
                'title'          => 'Diskon Pasti Ada',
                'discount_value' => 'Diskon 35% s.d Rp 40.000',
                'terms'          => 'Min. pembelian Rp 80.000, khusus pembayaran GoPay.',
                'valid_until'    => now()->addDays(30)->toDateString(),
                'is_active'      => true,
            ],
            [
                'platform'       => 'GrabFood',
                'title'          => 'Pesta Gajian',
                'discount_value' => 'Diskon 40%',
                'terms'          => 'Min. pembelian Rp 100.000. Berlaku jam 14:00 - 17:00.',
                'valid_until'    => now()->addDays(14)->toDateString(),
                'is_active'      => true,
            ],
            [
                'platform'       => 'ShopeeFood',
                'title'          => 'Flash Sale Kemerdekaan',
                'discount_value' => 'Diskon 50%',
                'terms'          => 'Maks. diskon Rp 25.000. Min. pembelian Rp 50.000.',
                'valid_until'    => now()->addDays(7)->toDateString(),
                'is_active'      => true,
            ],
        ];

        foreach ($promos as $p) {
            Promo::firstOrCreate(['title' => $p['title']], $p);
        }
    }
}
