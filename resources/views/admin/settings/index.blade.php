@extends('admin.layouts.app')
@section('header_title', 'Link Platform')
@section('content')

<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-xl text-[#3D1A10]">Tautan Platform Delivery</h2>
            <p class="text-sm text-slate-400 mt-0.5">Tautan ini akan muncul pada menu order di website</p>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-sm border border-white/60">

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <!-- GoFood -->
            <div class="group relative">
                <label class="flex items-center gap-3 text-sm font-semibold text-[#3D1A10] mb-2.5">
                    <div class="w-9 h-9 rounded-full bg-[#EE2737] flex items-center justify-center text-white shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="7.5" stroke="currentColor" stroke-width="3" fill="none" />
                            <circle cx="12" cy="12" r="3.5" fill="currentColor" />
                        </svg>
                    </div>
                    Tautan GoFood
                </label>
                <input type="url" name="link_gofood" value="{{ old('link_gofood', $settings['link_gofood'] ?? '') }}"
                       placeholder="https://gofood.co.id/..."
                       class="w-full px-4 py-3 bg-white text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#EE2737]/30 focus:border-[#EE2737] hover:border-gray-300 outline-none transition-all shadow-sm">
            </div>

            <!-- GrabFood -->
            <div class="group relative">
                <label class="flex items-center gap-3 text-sm font-semibold text-[#3D1A10] mb-2.5">
                    <div class="w-9 h-9 rounded-full bg-[#00B14F] flex items-center justify-center text-white shadow-sm group-hover:scale-110 transition-transform">
                        <span class="font-black italic tracking-tighter text-[11px] pr-0.5">Grab</span>
                    </div>
                    Tautan GrabFood
                </label>
                <input type="url" name="link_grabfood" value="{{ old('link_grabfood', $settings['link_grabfood'] ?? '') }}"
                       placeholder="https://food.grab.com/..."
                       class="w-full px-4 py-3 bg-white text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#00B14F]/30 focus:border-[#00B14F] hover:border-gray-300 outline-none transition-all shadow-sm">
            </div>

            <!-- ShopeeFood -->
            <div class="group relative">
                <label class="flex items-center gap-3 text-sm font-semibold text-[#3D1A10] mb-2.5">
                    <div class="w-9 h-9 rounded-full bg-[#EE4D2D] flex items-center justify-center text-white shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4 relative top-[-1px]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19,7h-3V6a4,4,0,0,0-8,0V7H5A2,2,0,0,0,3,9V21a2,2,0,0,0,2,2H19a2,2,0,0,0,2-2V9A2,2,0,0,0,19,7ZM10,6a2,2,0,0,1,4,0V7H10ZM19,21H5V9H8v2a1,1,0,0,0,2,0V9h4v2a1,1,0,0,0,2,0V9h3Z"/>
                            <text x="12" y="18" font-family="Arial, sans-serif" font-weight="900" font-size="8" fill="#EE4D2D" text-anchor="middle">S</text>
                        </svg>
                    </div>
                    Tautan ShopeeFood
                </label>
                <input type="url" name="link_shopeefood" value="{{ old('link_shopeefood', $settings['link_shopeefood'] ?? '') }}"
                       placeholder="https://shopee.co.id/..."
                       class="w-full px-4 py-3 bg-white text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#EE4D2D]/30 focus:border-[#EE4D2D] hover:border-gray-300 outline-none transition-all shadow-sm">
            </div>
            
            <hr class="border-gray-100 my-4">

            <!-- Hero Image -->
            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-2.5">
                    Gambar Utama (Hero Section) Depan
                </label>
                <div class="flex items-start gap-4">
                    @php
                        $heroImage = $settings['hero_image'] ?? null;
                        $heroUrl = $heroImage ? asset('storage/' . $heroImage) : 'https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=600&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $heroUrl }}" alt="Hero Image" class="w-24 h-24 rounded-2xl object-cover border border-gray-200 shadow-sm">
                    <div class="flex-1">
                        <input type="file" name="hero_image" accept="image/*"
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#FF7A00] hover:file:bg-orange-100 cursor-pointer border border-gray-200 rounded-xl p-2 bg-white">
                        <p class="text-xs text-slate-400 mt-2">Biarkan kosong jika tidak ingin mengubah gambar. Rekomendasi rasio 1:1 (persegi).</p>
                    </div>
                </div>
            </div>

            <div class="pt-6 mt-8 border-t border-gray-100">
                <button type="submit" class="w-full px-6 py-3.5 rounded-xl bg-gradient-to-r from-[#FF7A00] to-[#FF9933] text-white font-bold text-sm shadow-[0_4px_15px_rgba(255,122,0,0.25)] hover:shadow-[0_6px_20px_rgba(255,122,0,0.4)] hover:-translate-y-0.5 transition-all">
                    Simpan Perubahan Tautan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
