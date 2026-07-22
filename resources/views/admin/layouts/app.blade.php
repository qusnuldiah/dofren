<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - DoFren Donut</title>
    <link rel="icon" href="{{ asset('images/logo dofren.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-body text-slate-800 antialiased">
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-50 overflow-hidden w-full relative z-0">
        <!-- Abstract Background Blobs -->
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#FF7A00]/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[35rem] h-[35rem] bg-[#3D1A10]/5 rounded-full blur-[100px] -z-10 pointer-events-none"></div>


        <!-- Sidebar -->
        <aside x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" 
               class="fixed inset-y-0 left-0 z-50 w-64 h-full m-0 md:relative md:h-[calc(100vh-2rem)] md:m-4 md:rounded-3xl shadow-[4px_0_24px_rgba(0,0,0,0.04)] border border-white/80 bg-gradient-to-b from-white/90 via-[#FFF1EB]/80 to-white/90 backdrop-blur-2xl flex flex-col transform transition-transform duration-300 ease-in-out">
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center justify-center px-4">
                <img src="{{ asset('images/logo dofren.png') }}" alt="DoFren" class="h-16 md:h-20 w-auto object-contain mx-auto mt-4 mb-6">
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>', 'active' => request()->routeIs('admin.dashboard')],
                        ['route' => 'admin.categories.index', 'label' => 'Kelola Kategori', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>', 'active' => request()->routeIs('admin.categories.*')],
                        ['route' => 'admin.products.index', 'label' => 'Menu & Harga', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>', 'active' => request()->routeIs('admin.products.*')],
                        ['route' => 'admin.branches.index', 'label' => 'Lokasi Cabang', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>', 'active' => request()->routeIs('admin.branches.*')],
                        ['route' => 'admin.settings.index', 'label' => 'Link Platform', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>', 'active' => request()->routeIs('admin.settings.*')],
                        ['route' => 'admin.promos.index', 'label' => 'Promo N8N', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>', 'active' => request()->routeIs('admin.promos.*')],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-3 py-2.5 px-4 text-sm font-medium rounded-lg transition-all {{ $item['active'] ? 'bg-gradient-to-r from-[#FF7A00] to-[#FF9933] text-white font-bold shadow-lg shadow-orange-500/30 border-none rounded-xl transform scale-105 transition-all duration-300' : 'text-gray-500 hover:text-[#FF7A00] hover:bg-orange-50/50 hover:translate-x-1 transition-all duration-300 font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- User/Logout -->
            <div class="flex-shrink-0 p-4 border-t border-gray-200">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-900/60 backdrop-blur-sm md:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden relative z-10">
            
            <!-- Top Header -->
            <header class="mx-4 mt-4 px-6 py-3 rounded-full shadow-sm bg-gradient-to-r from-white/90 to-[#FFF1EB]/80 backdrop-blur-2xl border border-white/80 flex items-center justify-between sticky top-4 z-40">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-[#FF7A00] focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="font-heading font-bold text-lg md:text-xl text-[#3D1A10]">
                        @yield('header_title', 'Dashboard')
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center gap-2 hover:bg-orange-50 px-2 py-1.5 rounded-xl transition-colors outline-none">
                            <span class="text-sm font-semibold text-[#3D1A10] hidden sm:inline-block">Halo, {{ auth('admin')->user()->name }}</span>
                            <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-[#FF7A00] font-bold">
                                {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
                            </div>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="dropdownOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute right-0 mt-2 w-48 bg-white/95 backdrop-blur-md border border-gray-100 rounded-xl shadow-lg py-2 z-50"
                             style="display: none;">
                            
                            <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#FF7A00] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Edit Profil
                            </a>
                            
                            <hr class="my-1 border-gray-100">
                            
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content (Scrollable) -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Global Toast -->
    <div x-data="{ show: false, message: '' }" 
         @notify.window="message = $event.detail; show = true; setTimeout(() => show = false, 3000)" 
         x-show="show" 
         x-transition 
         class="fixed bottom-5 right-5 bg-gray-900 text-white px-6 py-3 rounded-xl shadow-2xl flex items-center gap-3 z-50 text-sm font-semibold"
         style="display: none;">
        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span x-text="message"></span>
    </div>

    <!-- Global Delete Confirm Modal -->
    <div x-data="{ show: false, url: '' }" 
         @confirm-delete.window="show = true; url = $event.detail"
         x-show="show" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50"
         style="display: none;">
        <div @click.away="show = false" class="bg-white rounded-2xl p-6 shadow-xl max-w-sm w-full mx-4" x-show="show" x-transition>
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-gray-900">Konfirmasi Hapus</h3>
                    <p class="text-sm text-gray-500 mt-1">Yakin ingin menghapus data ini? Aksi tidak dapat dibatalkan.</p>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button @click="show = false" class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Batal</button>
                <form :action="url" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        document.addEventListener('alpine:init', () => {
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent('notify', { detail: "{{ session('success') }}" }));
            }, 100);
        });
    </script>
    @endif

</body>
</html>
