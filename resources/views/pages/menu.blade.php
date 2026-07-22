@extends('layouts.app')

@section('title', 'DoFren Donut - Menu')

@section('content')

    {{-- Page Header --}}
    <div class="px-6 pt-4 pb-4 max-w-6xl mx-auto">
        <p class="text-[#FF7A00] text-xs font-bold tracking-widest uppercase mb-2">Temukan Favoritmu</p>
        <h1 class="font-heading font-extrabold text-3xl md:text-4xl text-[#3D1A10] mb-2">Pilih Teman Manismu</h1>
        <p class="text-slate-500 text-sm">Semua donat dibuat setiap pagi. Selagi hangat!</p>
    </div>

    {{-- Main Menu Component (Alpine.js) --}}
    <div x-data="{ activeCategory: 'Semua' }">
        
        {{-- Filter Pills --}}
        <div class="px-6 pb-6 overflow-x-auto no-scrollbar sticky top-16 md:top-24 z-30 bg-[#FFFDF9]/95 backdrop-blur-sm pt-3 border-b border-orange-50">
            <div class="max-w-6xl mx-auto flex gap-2 whitespace-nowrap">
                <button @click="activeCategory = 'Semua'" 
                        :class="activeCategory === 'Semua' ? 'bg-[#FF7A00] text-white shadow-lg transform scale-105' : 'bg-white text-gray-600 border border-gray-200 hover:bg-orange-50 hover:text-[#FF7A00]'" 
                        class="inline-block px-6 py-2 rounded-full font-semibold text-sm transition-all duration-300 cursor-pointer focus:outline-none">
                    Semua
                </button>
                @foreach($categories as $cat)
                <button @click="activeCategory = '{{ $cat->name }}'" 
                        :class="activeCategory === '{{ $cat->name }}' ? 'bg-[#FF7A00] text-white shadow-lg transform scale-105' : 'bg-white text-gray-600 border border-gray-200 hover:bg-orange-50 hover:text-[#FF7A00]'" 
                        class="inline-block px-6 py-2 rounded-full font-semibold text-sm transition-all duration-300 cursor-pointer focus:outline-none">
                    {{ $cat->name == 'Premium' ? 'Signature' : $cat->name }}
                </button>
                @endforeach
            </div>
        </div>

        {{-- Product Sections --}}
        <div class="px-6 py-10 pb-16 max-w-6xl mx-auto space-y-14 relative">
            
            <!-- SVG Blob Background -->
            <svg class="absolute top-10 right-0 -mr-20 -mt-20 w-[500px] h-[500px] opacity-10 text-[#FF7A00] pointer-events-none" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
              <path fill="currentColor" d="M43.9,-76.3C55.6,-68.8,63,-53.4,70.5,-39C78.1,-24.5,85.8,-11,84.6,1.8C83.4,14.5,73.4,26.4,63.1,36.5C52.7,46.7,42,55.1,30.3,60.6C18.6,66.2,5.9,68.9,-7.4,68.9C-20.6,68.9,-34.5,66.1,-46.8,59.3C-59.2,52.5,-70.2,41.7,-77.3,28.7C-84.4,15.6,-87.5,0.4,-84.9,-13.7C-82.3,-27.7,-74.1,-40.5,-63.1,-50.2C-52,-59.8,-38.3,-66.2,-25,-71.4C-11.6,-76.6,1.4,-80.7,16.5,-80.1C31.5,-79.6,48.5,-74.4,43.9,-76.3Z" transform="translate(100 100)" />
            </svg>

            @foreach($categories as $category)
                <div x-show="activeCategory === 'Semua' || activeCategory === '{{ $category->name }}'" 
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="scroll-mt-32 relative z-10">

                    {{-- Category Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="font-heading font-extrabold text-xl md:text-2xl text-[#3D1A10]">
                                {{ $category->name == 'Premium' ? 'Signature' : $category->name }}
                            </h2>
                            <p class="text-xs text-slate-400 mt-0.5">
                                {{ $category->products->count() }} produk tersedia
                            </p>
                        </div>

                    </div>

                    @if($category->name == 'Premium' || $category->name == 'Minuman')
                        {{-- LIST VIEW for Signature & Minuman --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($category->products as $product)
                                <div
                                    onclick="document.getElementById('isModalOpen') && (document.querySelector('[x-data]').__x.$data.isModalOpen = true)"
                                    x-data
                                    @click="$dispatch('open-order-modal')"
                                    class="bg-white rounded-2xl p-3 flex gap-4 items-center shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-orange-100 transition-all duration-500 border border-transparent cursor-pointer group"
                                >
                                    <img
                                        src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=200&q=80' }}"
                                        alt="{{ $product->name }}"
                                        class="w-20 h-20 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform duration-500"
                                    >
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-heading font-bold text-[#3D1A10] text-sm leading-snug mb-1 line-clamp-1">{{ $product->name }}</h3>
                                        <p class="text-xs text-slate-400 line-clamp-2 mb-2 leading-relaxed">{{ $product->description }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-[#FF7A00] text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <button class="w-7 h-7 rounded-full bg-[#FF7A00]/10 text-[#FF7A00] group-hover:bg-[#FF7A00] group-hover:text-white flex items-center justify-center transition-colors duration-300">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v14M5 12h14"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- GRID VIEW for Classic --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($category->products as $product)
                                <div
                                    x-data
                                    @click="$dispatch('open-order-modal')"
                                    class="cursor-pointer h-full"
                                >
                                    <x-product-card 
                                        :image="$product->image_url ?? 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=400&q=80'"
                                        :title="$product->name"
                                        :price="$product->price"
                                        :description="$product->description"
                                    />
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            @endforeach

        </div>
    </div>
@endsection
