<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Branch;

use App\Models\Category;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBestsellers = Product::where('is_bestseller', true)->count();
        
        $recentOrders = Order::with('branch')
            ->latest()
            ->take(5)
            ->get();
            
        $bestsellerProducts = Product::with('category')
            ->where('is_bestseller', true)
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalCategories', 
            'totalBestsellers',
            'recentOrders',
            'bestsellerProducts'
        ));
    }
}
