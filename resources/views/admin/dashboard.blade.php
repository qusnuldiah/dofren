@extends('admin.layouts.app')

@section('header_title', 'Dashboard')

@section('content')
<style>
    @keyframes gradient-pan { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
    .animate-gradient-pan { background-size: 200% 200%; animation: gradient-pan 8s ease infinite; }
</style>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-8">
    
    <div class="group relative overflow-hidden rounded-3xl p-6 shadow-sm border border-white/80 bg-gradient-to-br from-white via-[#FFF1EB]/80 to-white animate-gradient-pan hover:shadow-[0_8px_30px_rgba(255,122,0,0.1)] hover:-translate-y-1 transition-all duration-300 z-10 flex items-center justify-between">
        <div class="absolute -right-8 -top-8 w-24 h-24 bg-gradient-to-br from-[#FF7A00]/10 to-[#FF9933]/5 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700 -z-10"></div>
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center text-[#FF7A00] shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">Total Produk</p>
                <h3 class="text-3xl font-heading font-bold text-[#3D1A10]">{{ $totalProducts }}</h3>
            </div>
        </div>
    </div>

    <div class="group relative overflow-hidden rounded-3xl p-6 shadow-sm border border-white/80 bg-gradient-to-br from-white via-[#FFF1EB]/80 to-white animate-gradient-pan hover:shadow-[0_8px_30px_rgba(255,122,0,0.1)] hover:-translate-y-1 transition-all duration-300 z-10 flex items-center justify-between">
        <div class="absolute -right-8 -top-8 w-24 h-24 bg-gradient-to-br from-[#FF7A00]/10 to-[#FF9933]/5 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700 -z-10"></div>
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center text-[#FF7A00] shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">Promo Aktif</p>
                <h3 class="text-3xl font-heading font-bold text-[#3D1A10]">{{ $activePromos }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="rounded-3xl p-8 shadow-sm border border-white/80 bg-gradient-to-r from-white via-[#FFFDF9] to-[#FFF1EB]/50 animate-gradient-pan mt-8 text-center">
    <h2 class="text-xl font-heading font-bold text-[#3D1A10] mb-2">Selamat Datang di Admin Panel DoFren!</h2>
</div>
@endsection
