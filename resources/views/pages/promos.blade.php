@extends('layouts.app')

@section('title', 'DoFren Donut - Promo & Deals')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-10 text-center">
        <p class="text-[#FF7A00] text-xs font-bold tracking-widest uppercase mb-2">Hemat Lebih Banyak</p>
        <h1 class="font-heading font-extrabold text-3xl md:text-4xl text-[#3D1A10] mb-3">Promo & Deals</h1>
        <p class="text-slate-500 text-sm md:text-base">Nikmati donat favoritmu dengan harga lebih hemat! Klaim promonya sekarang.</p>
    </div>

    {{-- Dynamic Promo Grid from DB (via n8n) --}}
    @if(isset($promos) && $promos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($promos as $promo)
                @php
                    $platformColors = [
                        'GoFood'     => ['bg' => 'bg-red-600',    'light' => 'bg-red-50',    'text' => 'text-red-600',    'letter' => 'G'],
                        'GrabFood'   => ['bg' => 'bg-green-600',  'light' => 'bg-green-50',  'text' => 'text-green-600',  'letter' => 'Gr'],
                        'ShopeeFood' => ['bg' => 'bg-orange-500', 'light' => 'bg-orange-50', 'text' => 'text-orange-500', 'letter' => 'S'],
                    ];
                    $pc = $platformColors[$promo->platform] ?? ['bg' => 'bg-slate-500', 'light' => 'bg-slate-50', 'text' => 'text-slate-500', 'letter' => '?'];
                @endphp
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden flex flex-col h-full hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 {{ $pc['bg'] }} text-white font-bold text-xs px-4 py-2 rounded-bl-xl shadow-sm z-10">
                        {{ $promo->platform }}
                    </div>
                    <div class="flex-grow">
                        <div class="w-16 h-16 rounded-full {{ $pc['light'] }} flex items-center justify-center mb-4 {{ $pc['text'] }} font-bold text-2xl">
                            {{ $pc['letter'] }}
                        </div>
                        <h3 class="font-heading font-bold text-xl text-[#3D1A10] mb-2">{{ $promo->title }}</h3>
                        @if($promo->discount_value)
                            <p class="text-2xl font-extrabold text-[#FF7A00] mb-2">{{ $promo->discount_value }}</p>
                        @endif
                        @if($promo->terms)
                            <p class="text-slate-500 text-sm mb-4">{{ $promo->terms }}</p>
                        @endif
                        @if($promo->valid_until)
                            <span class="inline-block text-xs font-bold text-red-500 bg-red-50 px-3 py-1 rounded-full mb-4">
                                Berlaku s/d {{ \Carbon\Carbon::parse($promo->valid_until)->translatedFormat('d F Y') }}
                            </span>
                        @endif
                    </div>
                    <a href="#" x-data @click.prevent="$dispatch('open-modal')" class="mt-auto block w-full text-center font-bold rounded-xl py-3 border-2 border-[#FF7A00] text-[#FF7A00] hover:bg-[#FF7A00] hover:text-white transition-colors duration-300 cursor-pointer">
                        Klaim Promo
                    </a>
                </div>
            @endforeach
        </div>
    @else
        {{-- Static fallback promos when DB is empty --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach([
                ['platform' => 'GoFood',     'bg' => 'bg-red-600',    'light' => 'bg-red-50',    'text' => 'text-red-600',    'letter' => 'G',  'title' => 'Diskon s/d 50%',         'desc' => 'Nikmati potongan harga hingga 50% untuk semua menu dengan metode pembayaran GoPay.'],
                ['platform' => 'GrabFood',   'bg' => 'bg-green-600',  'light' => 'bg-green-50',  'text' => 'text-green-600',  'letter' => 'Gr', 'title' => 'Gratis Ongkir Sepuasnya', 'desc' => 'Pesan sekarang dan nikmati gratis ongkir sepuasnya tanpa minimal belanja khusus member GrabUnlimited.'],
                ['platform' => 'ShopeeFood', 'bg' => 'bg-orange-500', 'light' => 'bg-orange-50', 'text' => 'text-orange-500', 'letter' => 'S',  'title' => 'Cashback 30% Koin Shopee', 'desc' => 'Dapatkan cashback koin Shopee hingga 30% setiap pembelian menu favoritmu.'],
            ] as $p)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden flex flex-col h-full hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 {{ $p['bg'] }} text-white font-bold text-xs px-4 py-2 rounded-bl-xl shadow-sm z-10">{{ $p['platform'] }}</div>
                    <div class="flex-grow">
                        <div class="w-16 h-16 rounded-full {{ $p['light'] }} flex items-center justify-center mb-4 {{ $p['text'] }} font-bold text-2xl">{{ $p['letter'] }}</div>
                        <h3 class="font-heading font-bold text-xl text-[#3D1A10] mb-2">{{ $p['title'] }}</h3>
                        <p class="text-slate-500 text-sm mb-6">{{ $p['desc'] }}</p>
                    </div>
                    <a href="#" x-data @click.prevent="$dispatch('open-modal')" class="mt-auto block w-full text-center font-bold rounded-xl py-3 border-2 border-[#FF7A00] text-[#FF7A00] hover:bg-[#FF7A00] hover:text-white transition-colors duration-300 cursor-pointer">
                        Klaim Promo
                    </a>
                </div>
            @endforeach
        </div>
    @endif



</div>
@endsection
