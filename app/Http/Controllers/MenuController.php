<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('name', '!=', 'Minuman')
            ->withCount(['products' => fn($q) => $q->where('is_available', true)])
            ->with(['products' => fn($q) => $q->where('is_available', true)->orderBy('name')])
            ->orderBy('name')
            ->get();

        $query = Product::with('category')->where('is_available', true);

        if ($request->has('kategori') && $request->kategori !== 'semua') {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->kategori));
        }

        if ($request->has('q') && $request->q) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->orderBy('name')->get();

        $activeCategory = $request->get('kategori', 'semua');

        return view('pages.menu', compact('categories', 'products', 'activeCategory'));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_available', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }
}
