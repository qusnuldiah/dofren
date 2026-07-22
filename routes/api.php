<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PromoController;

Route::post('/update-promo', [PromoController::class, 'updatePromo']);
