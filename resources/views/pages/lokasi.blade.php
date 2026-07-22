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

                {{-- Destination Pin --}}
                <div class="absolute right-0 z-10 text-[#3D1A10] flex flex-col items-center animate-bounce" style="animation-duration: 2s;">
                    <svg class="w-10 h-10 drop-shadow-md" viewBox="0 0 24 24" fill="currentColor">
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
                        <svg class="shrink-0 mt-0.5 text-[#FF7A00]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <p>{{ $branch->address }}, {{ $branch->city }}</p>
                    </div>

                    @if($branch->open_hours)
                        <div class="flex gap-3 text-slate-500 text-sm mb-5">
                            <svg class="shrink-0 mt-0.5 text-slate-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <p>{{ $branch->open_hours }}</p>
                        </div>
                    @endif

                    <div class="flex gap-3">
                        <a href="{{ $branch->maps_embed ?? '#' }}" target="{{ $branch->maps_embed ? '_blank' : '' }}"
                           class="flex-1 bg-orange-50 hover:bg-orange-100 text-[#FF7A00] text-sm font-bold py-2.5 rounded-xl text-center flex items-center justify-center gap-2 transition-colors">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            Lihat di Maps
                        </a>
                        @if($branch->phone)
                            <a href="tel:{{ $branch->phone }}" class="w-12 bg-slate-100 hover:bg-slate-200 text-[#3D1A10] rounded-xl flex items-center justify-center transition-colors" title="Hubungi">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
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
                    <span class="bg-green-100 text-green-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Buka</span>
                </div>
                <div class="flex gap-3 text-slate-500 text-sm mb-2">
                    <svg class="shrink-0 mt-0.5 text-[#FF7A00]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <p>Jl. Sudirman No. 45, Malang 65100</p>
                </div>
                <div class="flex gap-3 text-slate-500 text-sm mb-5">
                    <svg class="shrink-0 mt-0.5 text-slate-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
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
