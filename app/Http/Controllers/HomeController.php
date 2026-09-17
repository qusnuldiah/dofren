<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products based on bestsellers
        $featuredProducts = Product::with('category')
            ->where('is_available', true)
            ->where('is_bestseller', true)
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
            'featuredProducts', 'categories', 'bestSellers', 'newProducts'
        ));
    }
}
