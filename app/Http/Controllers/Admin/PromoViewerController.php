<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoViewerController extends Controller
{
    public function index(Request $request)
    {
        $promos = Promo::latest('valid_until')->paginate(20)->appends($request->query());
        return view('admin.promos.index', compact('promos'));
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil dihapus.');
    }
}
