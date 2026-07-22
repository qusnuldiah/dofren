<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Promo;

class HomeController extends Controller
{
    public function index()
    {
        $promos = Promo::where('is_active', true)->get();

        // Get featured products; fall back to bestsellers, then all available
        $featuredProducts = Product::with('category')
            ->where('is_available', true)
            ->where(fn($q) => $q->where('is_featured', true)->orWhere('is_bestseller', true))
            ->take(8)
            ->get();

        // If still empty, grab the first 8 available products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')
                ->where('is_available', true)
                ->take(8)
                ->get();
        }

        $categories = Category::withCount(['products' => fn($q) => $q->where('is_available', true)])
            ->orderBy('name')
            ->get();

        $bestSellers = Product::with('category')
            ->where('is_bestseller', true)
            ->where('is_available', true)
            ->take(4)
            ->get();

        $newProducts = Product::with('category')
            ->where('is_available', true)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.home', compact(
            'promos', 'featuredProducts', 'categories', 'bestSellers', 'newProducts'
        ));
    }
}
