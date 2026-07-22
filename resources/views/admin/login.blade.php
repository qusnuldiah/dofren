<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - DoFren Donut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-[#FFFDF9] to-[#FFF1EB] font-body flex items-center justify-center min-h-screen p-4">

    <div class="bg-white/80 backdrop-blur-xl p-8 md:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white max-w-md w-full relative overflow-hidden">
        
        <!-- Decorative blobs -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#FF7A00]/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-pink-400/10 rounded-full blur-2xl"></div>

        <div class="relative z-10">
            <div class="text-center mb-8">
                <img src="/images/logo dofren.png" alt="DoFren Logo" class="h-16 mx-auto mb-4 object-contain">
                <h1 class="text-2xl font-heading font-bold text-[#3D1A10]">Admin Panel</h1>
                <p class="text-slate-500 text-sm mt-1">Masuk untuk mengelola sistem DoFren.</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 text-red-600 text-sm p-4 rounded-xl border border-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent transition-all outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                    <div x-data="{ show: false }" class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" required
                               class="w-full pl-4 pr-12 py-3 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent transition-all outline-none text-sm">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-[#FF7A00] focus:outline-none transition-colors">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="show" class="w-5 h-5" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-[#FF7A00] rounded border-slate-300 focus:ring-[#FF7A00]">
                    <label for="remember" class="ml-2 text-sm text-slate-500">Ingat Saya</label>
                </div>
                <button type="submit" class="w-full py-3.5 bg-[#FF7A00] hover:bg-[#e66d00] text-white font-bold rounded-xl shadow-lg shadow-orange-300/50 transition-all duration-300 transform hover:-translate-y-0.5">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>

</body>
</html>
