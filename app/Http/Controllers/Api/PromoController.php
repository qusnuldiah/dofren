<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PromoController extends Controller
{
    public function updatePromo(Request $request)
    {
        // Simple Bearer token security check
        $token = $request->bearerToken();
        if ($token !== env('N8N_API_TOKEN', 'dofren-secret-token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'promos' => 'required|array',
            'promos.*.platform' => 'required|in:GoFood,GrabFood,ShopeeFood',
            'promos.*.title' => 'required|string',
            'promos.*.discount_value' => 'nullable|string',
            'promos.*.terms' => 'nullable|string',
            'promos.*.valid_until' => 'nullable|date',
            'promos.*.is_active' => 'nullable|boolean',
        ]);

        // Wipe old promos and insert new ones from n8n
        Promo::truncate();

        $promos = $request->input('promos');
        foreach ($promos as $promoData) {
            Promo::create([
                'platform' => $promoData['platform'],
                'title' => $promoData['title'],
                'discount_value' => $promoData['discount_value'] ?? null,
                'terms' => $promoData['terms'] ?? null,
                'valid_until' => $promoData['valid_until'] ?? null,
                'is_active' => $promoData['is_active'] ?? true,
            ]);
        }

        // Immediately flush the cache so the frontend updates
        Cache::forget('active_promos');

        return response()->json([
            'message' => 'Promos updated successfully',
            'count' => count($promos)
        ]);
    }
}
