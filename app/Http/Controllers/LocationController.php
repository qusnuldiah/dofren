<?php

namespace App\Http\Controllers;

use App\Models\Branch;

class LocationController extends Controller
{
    public function index()
    {
        $branches = Branch::where('is_active', true)
            ->orderBy('id')
            ->get();

        return view('pages.lokasi', compact('branches'));
    }
}
