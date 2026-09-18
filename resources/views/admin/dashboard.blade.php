@extends('admin.layouts.app')

@section('header_title', 'Dashboard')

@section('content')
<style>
    @keyframes gradient-pan { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
    .animate-gradient-pan { background-size: 200% 200%; animation: gradient-pan 8s ease infinite; }
</style>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
    
    <!-- Produk -->
    <div class="group relative overflow-hidden rounded-3xl p-3 sm:p-4 shadow-sm border border-white/80 bg-gradient-to-br from-white via-[#FFF1EB]/80 to-white animate-gradient-pan hover:shadow-[0_8px_30px_rgba(255,122,0,0.1)] hover:-translate-y-1 transition-all duration-300 z-10 flex items-center justify-between">
        <div class="absolute -right-8 -top-8 w-24 h-24 bg-gradient-to-br from-[#FF7A00]/10 to-[#FF9933]/5 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700 -z-10"></div>
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-[#FF7A00] shrink-0">
                <svg aria-hidden="true" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <p class="text-xs sm:text-sm font-semibold text-gray-500 mb-1">Total Produk</p>
                <h3 class="text-xl sm:text-2xl font-heading font-bold text-[#3D1A10]">{{ $totalProducts }}</h3>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="group relative overflow-hidden rounded-3xl p-3 sm:p-4 shadow-sm border border-white/80 bg-gradient-to-br from-white via-[#FFF1EB]/80 to-white animate-gradient-pan hover:shadow-[0_8px_30px_rgba(255,122,0,0.1)] hover:-translate-y-1 transition-all duration-300 z-10 flex items-center justify-between">
        <div class="absolute -right-8 -top-8 w-24 h-24 bg-gradient-to-br from-[#FF7A00]/10 to-[#FF9933]/5 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700 -z-10"></div>
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-[#FF7A00] shrink-0">
                <svg aria-hidden="true" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <div>
                <p class="text-xs sm:text-sm font-semibold text-gray-500 mb-1">Total Kategori</p>
                <h3 class="text-xl sm:text-2xl font-heading font-bold text-[#3D1A10]">{{ $totalCategories }}</h3>
            </div>
        </div>
    </div>

    <!-- Bestseller -->
    <div class="group relative overflow-hidden rounded-3xl p-3 sm:p-4 shadow-sm border border-white/80 bg-gradient-to-br from-white via-[#FFF1EB]/80 to-white animate-gradient-pan hover:shadow-[0_8px_30px_rgba(255,122,0,0.1)] hover:-translate-y-1 transition-all duration-300 z-10 flex items-center justify-between">
        <div class="absolute -right-8 -top-8 w-24 h-24 bg-gradient-to-br from-[#FF7A00]/10 to-[#FF9933]/5 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700 -z-10"></div>
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-[#FF7A00] shrink-0">
                <svg aria-hidden="true" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <div>
                <p class="text-xs sm:text-sm font-semibold text-gray-500 mb-1">Produk Bestseller</p>
                <h3 class="text-xl sm:text-2xl font-heading font-bold text-[#3D1A10]">{{ $totalBestsellers }}</h3>
            </div>
        </div>
    </div>
</div>



<div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 mt-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-heading font-bold text-[#3D1A10]">Produk Bestseller</h2>
    </div>

    @if($bestsellerProducts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            @foreach($bestsellerProducts as $product)
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full group">
                    <!-- Image -->
                    <div class="aspect-square w-full relative bg-gray-50 overflow-hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy" width="200" height="200" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <!-- Content -->
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h3 class="font-heading font-bold text-[#3D1A10] line-clamp-2">{{ $product->name }}</h3>
                        </div>
                        <div class="mt-auto">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-[#FF7A00]">{{ $product->formatted_price }}</span>
                            </div>
                            <span class="inline-flex text-xs font-medium bg-orange-100 text-[#FF7A00] px-2 py-0.5 rounded-full">
                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="w-16 h-16 rounded-2xl bg-orange-50 text-[#FF7A00] flex items-center justify-center mx-auto mb-4">
                <svg aria-hidden="true" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <h3 class="text-lg font-heading font-bold text-[#3D1A10] mb-1">Belum ada Bestseller</h3>
            <p class="text-gray-500 text-sm">Tandai produk sebagai bestseller untuk menampilkannya di sini.</p>
        </div>
    @endif
</div>
@endsection
