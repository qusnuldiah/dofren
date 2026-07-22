<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Branch;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $activePromos = Promo::where('is_active', true)->count();
        $totalBranches = Branch::count();

        return view('admin.dashboard', compact('totalProducts', 'activePromos', 'totalBranches'));
    }
}
