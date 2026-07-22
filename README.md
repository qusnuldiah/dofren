# DoFren

DoFren adalah aplikasi web pemesanan donat yang dibangun menggunakan framework Laravel. Aplikasi ini dirancang untuk memudahkan pelanggan dalam melihat menu, menemukan lokasi cabang, mendapatkan informasi promo, serta melakukan pemesanan secara online.

## Fitur Utama

- **Katalog Menu & Detail Produk:** Menampilkan daftar lengkap makanan dan minuman beserta detailnya.
- **Pemesanan Online:** Fitur untuk melakukan pesanan (order) dengan mudah dan praktis.
- **Lokasi Cabang:** Informasi lokasi gerai DoFren yang dapat dikunjungi.
- **Promo & Diskon:** Menampilkan penawaran menarik dan promo terbaru.
- **Admin Dashboard:** Panel khusus untuk admin dalam mengelola data produk, kategori, pesanan, promo, cabang, dan pengaturan aplikasi.

## Teknologi yang Digunakan

- **Backend:** Laravel (PHP)
- **Frontend:** Blade Templating, HTML, CSS, JavaScript (Bootstrap/Tailwind)
- **Database:** MySQL

## Instalasi

1. Clone repositori ini:
   ```bash
   git clone https://github.com/qusnuldiah/dofren.git
   ```
2. Masuk ke direktori proyek:
   ```bash
   cd dofren
   ```
3. Install dependensi PHP dan Node.js:
   ```bash
   composer install
   npm install
   ```
4. Salin file `.env.example` menjadi `.env` dan atur konfigurasi database Anda:
   ```bash
   cp .env.example .env
   ```
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Jalankan migrasi dan seeder untuk database:
   ```bash
   php artisan migrate --seed
   ```
7. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
   Dan untuk asset frontend (opsional jika menggunakan Vite):
   ```bash
   npm run dev
   ```

Aplikasi dapat diakses melalui `http://localhost:8000`.
