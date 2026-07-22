<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hapus semua data donat (produk) dan data terkait
        Schema::disableForeignKeyConstraints();
        \App\Models\OrderItem::truncate();
        \App\Models\Order::truncate();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Persiapkan File Foto untuk disalin ke Public Storage agar bisa dibaca web
        $sourcePath = database_path('seeders/images/products');
        $destinationPath = storage_path('app/public/products');

        if (File::exists($sourcePath)) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            File::copyDirectory($sourcePath, $destinationPath);
        }

        // 3. Data Terkini
        $data = [
            'Donat Klasik' => [
                ['name' => 'Donat Cokelat Meises', 'price' => 6000, 'image' => 'products/gChjT6CH47ZRIRbQE3zKXHLyEmdywl13U8ZLrxwq.jpg'],
                ['name' => 'Donat Keju Parut', 'price' => 7000, 'image' => 'products/ooHoM8CtODjJ1iiP18GRODNWtzeKZmYVEtxgCJTZ.jpg'],
            ],
            'Donat Gurih' => [
                ['name' => 'Abon Keju', 'price' => 8000, 'image' => 'products/3m5hiJnRpAUkJjPhDasfajNKV30L67urZGfkbed3.jpg'],
                ['name' => 'Donat Abon', 'price' => 8000, 'image' => 'products/B4KRVVoMA7u8oysfPAdaY5uSSBvZKgwiUP2eYbvu.jpg'],
            ],
            'Donat Premium' => [
                ['name' => 'Donat sprinkle', 'price' => 9000, 'image' => 'products/uP6eSCcYBgm2XnqMqHwgrkkqVS9DL9rB5ZI6eS1G.jpg'],
                ['name' => 'Donat kacang', 'price' => 9000, 'image' => 'products/yyvYoB4WSbA5T1qDjbFyUYgHz9eI9rqImroxFvXP.jpg'],
                ['name' => 'Bomboloni', 'price' => 10000, 'image' => 'products/NRuyV90mUhfT6ejObVZazi9qPusmlHhatO8rvRhY.png'],
            ],
            'Donat Paket' => [
                ['name' => 'Paket Setengah Lusin (Isi 6)', 'price' => 35000, 'image' => 'products/RDocPNETDxjRSSv8YWWuQXbFLzAoDKGF9qctSnWu.jpg'],
                ['name' => 'Paket Lusinan (Isi 12)', 'price' => 65000, 'image' => 'products/kQeimKkuNhpedE9lnGeYoDMMe9eGCodtJU9hayl8.jpg'],
            ],
        ];

        // 4. Masukkan data ke Database
        $sortOrder = 1;
        foreach ($data as $categoryName => $products) {
            
            // Buat atau cari kategori
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                [
                    'slug' => Str::slug($categoryName),
                    'color' => '#FF7A00',
                    'sort_order' => $sortOrder++
                ]
            );

            // Masukkan produk
            foreach ($products as $prod) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'slug' => Str::slug($prod['name']),
                    'price' => $prod['price'],
                    'image' => $prod['image'],
                    'is_available' => true,
                ]);
            }
        }
    }
}
