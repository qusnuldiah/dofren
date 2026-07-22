<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');

// Promo
Route::get('/promo', function () {
    $promos = \App\Models\Promo::where('is_active', true)->get();
    return view('pages.promos', compact('promos'));
})->name('promo.index');

// Order
Route::get('/pesan', [OrderController::class, 'index'])->name('order.index');
Route::post('/pesan', [OrderController::class, 'store'])->name('order.store');
Route::get('/lacak-pesanan', [OrderController::class, 'track'])->name('order.track');

// Location
Route::get('/lokasi', [LocationController::class, 'index'])->name('location.index');

// Admin Panel Routes
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PromoViewerController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    
    // Auth
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Routes
    Route::middleware(['auth:admin', 'prevent.back'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // CRUD Kategori
        Route::resource('categories', CategoryController::class);
        
        // CRUD Menu & Harga
        Route::resource('products', ProductController::class);
        
        // CRUD Lokasi Cabang
        Route::resource('branches', BranchController::class);
        
        // Link Platform
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::match(['POST', 'PUT'], '/settings', [SettingController::class, 'update'])->name('settings.update');
        
        // Profile
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

        // Promo N8N Viewer
        Route::get('/promos', [PromoViewerController::class, 'index'])->name('promos.index');
        Route::delete('/promos/{promo}', [PromoViewerController::class, 'destroy'])->name('promos.destroy');
    });
});
