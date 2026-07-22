@extends('layouts.app')

@section('title', 'DoFren Donut - Promo & Diskon')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Page Header --}}
    <div class="pb-6 text-center">
        <h1 class="font-heading font-extrabold text-3xl text-[#3D1A10] mb-2">Banyak Untungnya! 🎁</h1>
        <p class="text-slate-500 text-sm">Amankan promomu sebelum kehabisan.</p>
    </div>

    {{-- Hero Promo --}}
    <div class="mb-8">
        <div class="bg-gradient-to-br from-[#FF7A00] to-orange-600 rounded-3xl p-6 text-white shadow-xl shadow-orange-500/30 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#3D1A10]/20 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <span class="inline-block bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase mb-4">Paling Cuan</span>
                <h2 class="font-heading font-extrabold text-3xl mb-2">Beli 6, Gratis 1!</h2>
                <p class="text-white/80 text-sm mb-6">Berlaku untuk semua donat classic dan signature. Yakin cuma mau lihat doang?</p>
                <button x-data @click="$dispatch('open-modal')"
                        class="bg-white text-[#FF7A00] font-bold py-3 px-6 rounded-full w-full sm:w-auto shadow-md hover:bg-orange-50 transition-colors flex justify-center items-center gap-2">
                    Klaim Promonya
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Grid Promos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-5 hover:border-[#FF7A00]/40 transition-colors">
            <div class="w-12 h-12 bg-pink-100 text-pink-500 rounded-2xl flex items-center justify-center mb-4 text-xl">🎓</div>
            <h3 class="font-heading font-bold text-lg text-[#3D1A10] mb-1">Diskon Pelajar</h3>
            <p class="text-slate-500 text-xs mb-4">Potongan 15% khusus buat kamu yang masih pusing nugas. Tunjukin Kartu Pelajar aja!</p>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-lg">Berakhir: 31 Okt</span>
                <button x-data @click="$dispatch('open-modal')" class="text-[#FF7A00] font-bold text-sm hover:underline">Pakai Kode →</button>
            </div>
        </div>

        <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-5 hover:border-[#FF7A00]/40 transition-colors">
            <div class="w-12 h-12 bg-amber-100 text-amber-500 rounded-2xl flex items-center justify-center mb-4 text-xl">☕</div>
            <h3 class="font-heading font-bold text-lg text-[#3D1A10] mb-1">Kopi Gratis Akhir Pekan</h3>
            <p class="text-slate-500 text-xs mb-4">Beli 1 lusin donat apa saja, bawa pulang 1 kopi gratis. Weekend makin chill.</p>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-xs font-bold text-[#3D1A10] bg-slate-100 px-2 py-1 rounded-lg">Sabtu & Minggu</span>
                <button x-data @click="$dispatch('open-modal')" class="text-[#FF7A00] font-bold text-sm hover:underline">Pakai Kode →</button>
            </div>
        </div>
    </div>

    {{-- Rewards Banner --}}
    <div class="bg-[#3D1A10] text-white rounded-3xl p-6 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center shrink-0 text-2xl">⭐</div>
            <div>
                <h3 class="font-heading font-bold text-lg">Member DoFren</h3>
                <p class="text-slate-300 text-xs">Kumpulin poin dari setiap gigitan.</p>
            </div>
        </div>
        <button x-data @click="$dispatch('open-modal')" class="bg-[#FF7A00] hover:bg-orange-500 text-white font-bold px-4 py-2.5 rounded-xl text-sm transition-colors flex-shrink-0">
            Daftar
        </button>
    </div>

</div>
@endsection
