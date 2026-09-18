<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DoFren Donut Malang - Toko donat kentang premium, lembut, dan fresh setiap hari di Malang. Banyak varian rasa, cocok untuk hampers dan cemilan keluarga.">
    <meta name="keywords" content="donat malang, donat kentang, dofren, dofren donat, donat premium, kuliner malang, hampers donat">
    <meta name="author" content="DoFren Donut">
    
    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'DoFren Donut Malang | Donat Kentang Premium')">
    <meta property="og:description" content="DoFren Donut - Toko donat kentang premium dan fresh setiap hari di Malang. Pesan sekarang untuk dikirim via GoFood, GrabFood, atau ShopeeFood!">
    <meta property="og:image" content="{{ asset('images/logo dofren.png') }}">

    <title>@yield('title', 'DoFren Donut Malang | Donat Kentang Premium')</title>
    <link rel="icon" href="{{ asset('images/logo dofren.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js (for Modal & Mobile Menu state management) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Store: Global modal state -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modal', { isOpen: false });
        });
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FFFDF9] text-slate-800 antialiased font-body overflow-x-hidden" x-data="{ isModalOpen: false, isMobileMenuOpen: false }">

    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-orange-100 shadow-sm border-t-4 border-t-[#FF7A00]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="block" aria-label="Go to Homepage">
                        <img src="{{ asset('images/logo dofren.png') }}" alt="DoFren Donut Logo" width="160" height="64" class="h-16 md:h-20 w-auto object-contain cursor-pointer transition-all duration-300 ease-out hover:scale-110 hover:-rotate-6">
                    </a>
                </div>
                
                <!-- Desktop Menu (Hidden on Mobile) -->
                <div class="hidden lg:flex space-x-8">
                    <a href="/" class="text-slate-600 hover:text-brand-orange font-medium transition">Home</a>
                    <a href="/menu" class="text-slate-600 hover:text-brand-orange font-medium transition">Menu</a>
                    <a href="/lokasi" class="text-slate-600 hover:text-brand-orange font-medium transition">Lokasi</a>
                </div>

                <!-- Mobile Menu Button (Hamburger) -->
                <div class="flex items-center lg:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" aria-label="Toggle mobile menu" aria-expanded="false" class="text-slate-600 hover:text-brand-orange focus:outline-none transition-colors">
                        <svg class="h-6 w-6" x-show="!isMobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6" x-show="isMobileMenuOpen" style="display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="isMobileMenuOpen" 
             style="display: none;" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden bg-white border-t border-slate-100 shadow-md absolute w-full left-0 z-40">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-brand-orange hover:bg-orange-50 transition-colors">Home</a>
                <a href="/menu" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-brand-orange hover:bg-orange-50 transition-colors">Menu</a>
                <a href="/lokasi" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-brand-orange hover:bg-orange-50 transition-colors">Lokasi</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 min-h-screen">
        @yield('content')
    </main>

    <!-- Floating CTA Wrapper -->
    <div x-data="{ 
            bottomOffset: 0,
            handleScroll() {
                const footer = document.getElementById('main-footer');
                if (!footer) return;
                const footerRect = footer.getBoundingClientRect();
                const windowHeight = window.innerHeight;
                if (footerRect.top < windowHeight) {
                    this.bottomOffset = windowHeight - footerRect.top;
                } else {
                    this.bottomOffset = 0;
                }
            }
         }" 
         @scroll.window="handleScroll"
         x-init="handleScroll"
         :style="`transform: translateY(-${bottomOffset}px);`"
         class="fixed bottom-6 right-6 md:bottom-8 md:right-8 lg:bottom-10 lg:right-10 z-30">
         
        <button @click="$store.modal.isOpen = true" class="bg-brand-orange hover:bg-[#e66d00] text-white font-bold py-3 px-6 rounded-full shadow-xl hover:shadow-2xl hover:scale-105 transform transition-all duration-300 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" viewBox="0 0 20 20" fill="currentColor">
              <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            <span class="text-sm md:text-base">Pesan Sekarang</span>
        </button>
    </div>

    <!-- Order Modal Component -->
    <x-order-modal />

    <!-- Footer -->
    <footer id="main-footer" class="bg-[#FFFDF9] border-t border-orange-100 py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
            <a href="/" aria-label="Homepage">
                <img src="{{ asset('images/logo dofren.png') }}" alt="DoFren Donut Footer Logo" width="160" height="64" class="h-16 w-auto object-contain mb-4">
            </a>
            <p class="text-sm text-gray-500 font-jakarta mb-4">
                DoFren Donut — Freshly baked everyday. Siap menemani hari manismu.
            </p>
            <p class="text-sm text-gray-500 font-jakarta">
                © 2026 DoFren Donut. All rights reserved.
            </p>
            
            @php
                $igLink = \App\Models\Setting::where('key', 'link_instagram')->first()->value ?? null;
                $tiktokLink = \App\Models\Setting::where('key', 'link_tiktok')->first()->value ?? null;
            @endphp
            
            @if($igLink || $tiktokLink)
            <div class="flex items-center gap-4 mt-6">
                @if($igLink)
                <a href="{{ $igLink }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram DoFren" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:text-white hover:bg-gradient-to-tr hover:from-[#f09433] hover:via-[#e6683c] hover:to-[#bc1888] transition-all hover:scale-110 shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2"></line>
                    </svg>
                </a>
                @endif
                
                @if($tiktokLink)
                <a href="{{ $tiktokLink }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok DoFren" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:text-white hover:bg-black transition-all hover:scale-110 shadow-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512">
                        <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                    </svg>
                </a>
                @endif
            </div>
            @endif
        </div>
    </footer>

</body>
</html>
