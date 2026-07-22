@extends('layouts.app')



@section('title', 'DoFren Donut - Pilih Teman Manismu')



@section('content')



    {{-- ================================================================

         2. HERO SECTION — 2-column desktop, stacked mobile

    ================================================================ --}}

    <section class="relative px-6 overflow-hidden bg-gradient-to-br from-[#FFFDF9] to-[#FFF1EB]">



        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 items-center max-w-7xl mx-auto px-4 min-h-[70vh]">



            {{-- Left: Typography & CTA --}}

            <div class="relative text-center md:text-left order-2 md:order-1 z-10">

                

                {{-- Decorative Sprinkles --}}

                <div class="absolute -top-10 left-10 w-3 h-3 bg-[#FF7A00] rounded-full opacity-60"></div>

                <div class="absolute top-10 lg:-right-4 w-4 h-4 bg-[#3D1A10] rounded-full opacity-30"></div>

                <div class="absolute bottom-10 left-0 w-2.5 h-2.5 bg-pink-400 rounded-full opacity-50"></div>



                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-100 text-[#FF7A00] text-sm font-bold mb-6 w-fit mx-auto lg:mx-0">

                    <span class="relative flex h-2 w-2">

                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#FF7A00] opacity-75"></span>

                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#FF7A00]"></span>

                    </span> 

                    100% Bahan Premium & Fresh

                </div>

                

                <h1 class="font-heading font-extrabold text-4xl lg:text-5xl text-[#3D1A10] leading-tight lg:leading-[1.2] mb-6">

                    Pilih Teman<br>

                    Manismu<br>

                    <span class="text-[#FF7A00]">Hari Ini.</span>

                </h1>

                <p class="text-slate-500 text-lg leading-relaxed max-w-md mx-auto lg:mx-0 mb-8">

                    Fresh dari oven setiap pagi. Siap diantar untuk menemani hari manismu.

                </p>

            </div>




            {{-- Right: Image with Blob & Animations --}}

            <div class="relative flex items-center justify-center order-1 md:order-2 z-10 mt-10 md:mt-0">



                {{-- Background Depth Blob --}}

                <div class="absolute inset-0 m-auto w-56 h-56 bg-[#FF7A00]/15 rounded-full blur-3xl -z-10"></div>



                {{-- Floating Product Image Container --}}

                <div class="relative w-full max-w-sm md:max-w-md mx-auto flex justify-center gentle-float">

                    @php
                        $heroImage = \App\Models\Setting::where('key', 'hero_image')->first()->value ?? null;
                        $heroUrl = $heroImage ? asset('storage/' . $heroImage) : 'https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=600&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $heroUrl }}"

                         alt="DoFren Signature Donut"

                         class="w-64 h-64 md:w-80 md:h-80 lg:w-96 lg:h-96 object-cover rounded-full mx-auto shadow-2xl border-8 border-white/70 relative z-10">

                    

                    {{-- Floating Trust Badge --}}

                    <div class="absolute bottom-0 -left-2 lg:-left-6 bg-white/95 backdrop-blur-sm p-3 rounded-2xl shadow-xl shadow-orange-100/50 border border-white flex items-center gap-3 z-20">

                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-lg">

                            🔥

                        </div>

                        <div>

                            <p class="text-xs font-bold text-[#3D1A10]">Favorit Warga</p>

                            <p class="text-[10px] text-slate-500 font-medium">Kota Malang</p>

                        </div>

                    </div>

                </div>



            </div>



        </div>

    </section>



    {{-- ================================================================

         3. UPGRADED PRODUCT / CATEGORIES SECTION

    ================================================================ --}}

    <section class="px-6 py-12 bg-gradient-to-br from-[#FFFDF9] to-[#FFF1EB] relative overflow-hidden">

        

        <!-- Subtle SVG Pattern Background -->

        <svg class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none" xmlns="http://www.w3.org/2000/svg">

            <defs>

                <pattern id="dotPattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">

                    <circle fill="#FF7A00" cx="20" cy="20" r="3"></circle>

                </pattern>

            </defs>

            <rect x="0" y="0" width="100%" height="100%" fill="url(#dotPattern)"></rect>

        </svg>



        <div class="max-w-6xl mx-auto relative z-10">



            {{-- Section Header --}}

            <div class="flex items-end justify-between mb-8">

                <div>

                    <p class="text-[#FF7A00] text-xs font-bold tracking-widest uppercase mb-1">Temukan Favoritmu</p>

                    <h2 class="font-heading font-extrabold text-2xl md:text-3xl text-[#3D1A10]">Menu Unggulan Kami</h2>

                </div>

                <a href="{{ route('menu.index') }}" class="text-sm font-bold text-[#FF7A00] hover:underline underline-offset-2 flex items-center gap-1">

                    Lihat Semua

                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>

                </a>

            </div>



            {{-- PRODUCT CARDS GRID from DB --}}

            @if($featuredProducts->count() > 0)

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    @foreach($featuredProducts as $product)

                        <div x-data @click="$dispatch('open-modal')" class="cursor-pointer h-full">

                            <x-product-card

                                :image="$product->image_url"

                                :title="$product->name"

                                :price="$product->price"

                                :description="$product->description"

                                :badge="$product->is_bestseller ? 'Bestseller' : ($product->is_new ? 'Baru' : null)"

                            />

                        </div>

                    @endforeach

                </div>

            @else

                {{-- Fallback showcase when DB has no featured products --}}

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    @foreach([

                        ['img' => 'photo-1551024601-bec78aea704b', 'name' => 'Choco Melt', 'desc' => 'Limpahan cokelat Belgia asli yang meleleh sempurna.', 'price' => '15.000', 'badge' => 'Bestseller', 'badge_color' => 'bg-[#FF7A00]'],

                        ['img' => 'photo-1541189872066-c9adb5745af3', 'name' => 'Strawberry Dream', 'desc' => 'Glazing stroberi segar dengan taburan sprinkle warna-warni.', 'price' => '14.000', 'badge' => 'Baru', 'badge_color' => 'bg-pink-500'],

                        ['img' => 'photo-1527515637462-cff94eecc1ac', 'name' => 'Classic Glazed', 'desc' => 'Donat klasik dengan glazing gula vanila yang sempurna.', 'price' => '10.000', 'badge' => null, 'badge_color' => ''],

                        ['img' => 'photo-1571506165871-ee72a35bc9d4', 'name' => 'Nutella Bomb', 'desc' => 'Filled dengan Nutella mewah, taburan hazelnut crunch di atas.', 'price' => '18.000', 'badge' => 'Limited', 'badge_color' => 'bg-amber-500'],

                    ] as $card)

                        <div class="group bg-white rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-orange-50 overflow-hidden flex flex-col cursor-pointer" x-data @click="$dispatch('open-modal')">

                            <div class="relative">

                                <img src="https://images.unsplash.com/{{ $card['img'] }}?q=80&w=400&auto=format&fit=crop" alt="{{ $card['name'] }}" class="h-48 w-full object-cover rounded-t-3xl group-hover:scale-105 transition-transform duration-500">

                                @if($card['badge'])

                                    <div class="absolute top-3 left-3 {{ $card['badge_color'] }} text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow">{{ $card['badge'] }}</div>

                                @endif

                            </div>

                            <div class="p-4 flex flex-col flex-grow">

                                <h3 class="font-heading font-bold text-[#3D1A10] text-base mb-1">{{ $card['name'] }}</h3>

                                <p class="text-xs text-slate-400 mb-3 flex-grow line-clamp-2">{{ $card['desc'] }}</p>

                                <div class="flex items-center justify-between mt-auto pt-3 border-t border-slate-50">

                                    <span class="font-bold text-[#FF7A00] text-base">Rp {{ $card['price'] }}</span>

                                    <button class="w-8 h-8 rounded-full bg-[#FF7A00]/10 text-[#FF7A00] hover:bg-[#FF7A00] hover:text-white flex items-center justify-center transition-colors">

                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14M5 12h14"/></svg>

                                    </button>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif



            {{-- See All CTA --}}

            <div class="text-center mt-10 mb-12">

                <a href="{{ route('menu.index') }}" class="inline-flex items-center gap-2 bg-white text-[#3D1A10] font-bold py-3 px-10 rounded-full border border-orange-100 shadow-sm hover:border-[#FF7A00] hover:text-[#FF7A00] hover:shadow-md transition-all duration-300">

                    Lihat Seluruh Menu

                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>

                </a>

            </div>





        </div>

    </section>



    {{-- ================================================================

         SOCIAL PROOF / VIBE STRIP

    ================================================================ --}}

    <section class="bg-[#3D1A10] py-10 px-6 text-white text-center">

        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4">

            <div>

                <p class="font-heading font-extrabold text-4xl md:text-3xl text-[#FF7A00]">5.000+</p>

                <p class="text-sm md:text-xs text-white/60 mt-1 font-medium">Donat Terjual / Bulan</p>

            </div>

            <div class="py-6 md:py-0 border-y md:border-y-0 md:border-x border-white/10">

                <p class="font-heading font-extrabold text-4xl md:text-3xl text-[#FF7A00]">4.9</p>

                <p class="text-sm md:text-xs text-white/60 mt-1 font-medium">Rating di GoFood</p>

            </div>

            <div>

                <p class="font-heading font-extrabold text-4xl md:text-3xl text-[#FF7A00]">100%</p>

                <p class="text-sm md:text-xs text-white/60 mt-1 font-medium">Bahan Segar Setiap Hari</p>

            </div>

        </div>

    </section>



@endsection
