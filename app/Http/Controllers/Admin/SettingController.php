<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'link_gofood' => 'nullable|url',
            'link_grabfood' => 'nullable|url',
            'link_shopeefood' => 'nullable|url',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        foreach ($validated as $key => $value) {
            if ($key === 'hero_image') {
                continue; // Handle separately
            }
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('hero', 'public');
            
            // Delete old image if exists
            $oldImage = Setting::where('key', 'hero_image')->first();
            if ($oldImage && $oldImage->value) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldImage->value);
            }

            Setting::updateOrCreate(
                ['key' => 'hero_image'],
                ['value' => $path]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Tautan platform berhasil diperbarui.');
    }
}
