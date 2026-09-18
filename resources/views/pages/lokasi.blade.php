@extends('layouts.app')

@section('title', 'DoFren Donut - Temukan Kami')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Page Header --}}
    <div class="pb-6 text-center">
        <p class="text-[#FF7A00] text-xs font-bold tracking-widest uppercase mb-2">Lokasi Gerai</p>
        <h1 class="font-heading font-extrabold text-3xl text-[#3D1A10] mb-2">Nyari Kita Ya?</h1>
        <p class="text-slate-500 text-sm">Masih hangat, fresh, dan deket banget dari kamu.</p>
    </div>

    {{-- Animated Illustration Card --}}
    <div class="mb-4">
        <div class="relative flex flex-col items-center justify-center h-24">
            
            <div class="relative w-full max-w-[260px] h-20 flex items-center">
                {{-- Dotted Path --}}
                <div class="absolute left-8 right-8 top-1/2 -translate-y-1/2 border-b-[3px] border-dashed border-orange-200"></div>

                <!-- Destination Pin -->
                <div class="absolute right-0 z-10 text-[#3D1A10] flex flex-col items-center animate-bounce" style="animation-duration: 2s;">
                    <svg aria-hidden="true" class="w-10 h-10 drop-shadow-md" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <div class="w-4 h-1.5 bg-orange-900/20 rounded-[100%] mt-1 blur-[1px]"></div>
                </div>

                {{-- Moving Donut --}}
                <div class="absolute left-0 z-20 animate-[moveDonut_4s_ease-in-out_infinite]">
                    <div class="relative animate-[spin_2s_linear_infinite]">
                        {{-- Donut Shape --}}
                        <div class="w-14 h-14 bg-[#FF7A00] rounded-full border-[5px] border-orange-100 shadow-lg flex items-center justify-center relative overflow-hidden">
                            <div class="w-4 h-4 bg-white/90 rounded-full border border-orange-300 shadow-inner"></div>
                            {{-- Sprinkles --}}
                            <div class="absolute top-2 left-3 w-1.5 h-1.5 bg-white rounded-full"></div>
                            <div class="absolute bottom-2 right-4 w-2 h-1 bg-yellow-300 rounded-full rotate-45"></div>
                            <div class="absolute top-4 right-2 w-1.5 h-1.5 bg-pink-300 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                @keyframes moveDonut {
                    0% { transform: translateX(0px); opacity: 0; }
                    10% { opacity: 1; }
                    80% { transform: translateX(200px); opacity: 1; }
                    100% { transform: translateX(220px); opacity: 0; }
                }
            </style>
        </div>
    </div>

    {{-- Branch List from DB --}}
    @if($branches->count() > 0)
        <div class="space-y-4 pb-12">
            @foreach($branches as $branch)
                <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-heading font-bold text-xl text-[#3D1A10]">{{ $branch->name }}</h3>
                        @if($branch->is_open_now)
                            <span class="bg-green-100 text-green-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider flex-shrink-0">Buka</span>
                        @else
                            <span class="bg-red-100 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider flex-shrink-0">Tutup</span>
                        @endif
                    </div>

                    <div class="flex gap-3 text-slate-500 text-sm mb-2">
                        <svg aria-hidden="true" class="shrink-0 mt-0.5 text-[#FF7A00]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <p>{{ $branch->address }}, {{ $branch->city }}</p>
                    </div>

                    @if($branch->open_hours)
                        <div class="flex gap-3 text-slate-500 text-sm mb-5">
                            <svg aria-hidden="true" class="shrink-0 mt-0.5 text-slate-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <p>{{ $branch->open_hours }}</p>
                        </div>
                    @endif

                    <div class="flex gap-3">
                        <a href="{{ $branch->maps_embed ?? '#' }}" target="{{ $branch->maps_embed ? '_blank' : '' }}" rel="noopener noreferrer"
                           class="flex-1 bg-orange-50 hover:bg-orange-100 text-[#FF7A00] text-sm font-bold py-2.5 rounded-xl text-center flex items-center justify-center gap-2 transition-colors">
                            <svg aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            Lihat di Maps
                        </a>
                        @if($branch->phone)
                            @php
                                $waNumber = preg_replace('/^0/', '62', preg_replace('/\D/', '', $branch->phone));
                            @endphp
                            <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" class="w-12 bg-[#25D366]/10 hover:bg-[#25D366]/20 text-[#25D366] rounded-xl flex items-center justify-center transition-colors" title="Chat WA" aria-label="WhatsApp {{ $branch->name }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.031 2C6.491 2 2 6.49 2 12.031a10.02 10.02 0 001.341 5.01L2 22l5.105-1.336a10.04 10.04 0 004.926 1.286c5.54 0 10.031-4.49 10.031-10.031S17.571 2 12.031 2zm5.077 14.471c-.212.597-1.229 1.15-1.688 1.226-.459.076-1.036.195-3.327-.75-2.753-1.135-4.526-3.953-4.662-4.136-.135-.183-1.115-1.488-1.115-2.837 0-1.348.706-2.012.96-2.285.253-.274.55-.343.734-.343.183 0 .367.003.52.008.163.006.38-.065.594.455.214.52.735 1.79.801 1.921.066.132.11.286.027.452-.083.167-.124.271-.248.416-.123.146-.263.323-.374.453-.122.143-.25.3-.11.542.14.242.622 1.031 1.334 1.666.917.818 1.696 1.074 1.936 1.19.241.116.382.096.527-.07.145-.167.622-.727.788-.976.167-.25.333-.208.55-.125.217.083 1.378.65 1.614.767.237.118.396.177.454.276.059.098.059.57-.153 1.167z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Fallback static branches --}}
        <div class="space-y-4 pb-12">
            <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-sm">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="font-heading font-bold text-xl text-[#3D1A10]">DoFren Malang</h3>
                    @php
                        $currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i');
                        $isOpenFallback = $currentTime >= '07:00' && $currentTime <= '22:00';
                    @endphp
                    @if($isOpenFallback)
                        <span class="bg-green-100 text-green-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Buka</span>
                    @else
                        <span class="bg-red-100 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Tutup</span>
                    @endif
                </div>
                <div class="flex gap-3 text-slate-500 text-sm mb-2">
                    <svg class="shrink-0 mt-0.5 text-[#FF7A00]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <p>Jl. Sudirman No. 45, Malang 65100</p>
                </div>
                <div class="flex gap-3 text-slate-500 text-sm mb-5">
                    <svg aria-hidden="true" class="shrink-0 mt-0.5 text-slate-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <p>07:00 - 22:00</p>
                </div>
                <div class="flex gap-3">
                    <a href="#" class="flex-1 bg-orange-50 hover:bg-orange-100 text-[#FF7A00] text-sm font-bold py-2.5 rounded-xl text-center transition-colors">Lihat di Maps</a>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
