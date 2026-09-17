@extends('admin.layouts.app')
@section('header_title', 'Edit Profil')
@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-sm border border-white/60">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center text-[#FF7A00] font-bold text-2xl shadow-sm border border-orange-200">
                {{ strtoupper(substr($admin->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-heading font-bold text-xl text-[#3D1A10]">Profil Admin</h2>
                <p class="text-sm text-slate-500 mt-0.5">Kelola informasi pribadi akun admin Anda.</p>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                <p class="font-semibold mb-1">Ada kesalahan:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $admin->name) }}" required
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Email / Username</label>
                <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                <p class="text-xs text-slate-400 mt-1">Email ini digunakan untuk login ke panel admin.</p>
            </div>
            
            <hr class="border-gray-100 my-6">
            
            <div class="mb-2">
                <h3 class="font-bold text-[#3D1A10]">Ganti Password</h3>
                <p class="text-xs text-slate-500 mt-0.5">Kosongkan kolom di bawah ini jika Anda tidak ingin mengganti password.</p>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Password Lama</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="current_password" placeholder="Masukkan password lama untuk konfirmasi"
                           class="w-full px-4 py-3 pr-12 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-[#FF7A00]">
                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Password Baru</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password" placeholder="Minimal 8 karakter"
                           class="w-full px-4 py-3 pr-12 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-[#FF7A00]">
                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password_confirmation" placeholder="Ulangi password baru"
                           class="w-full px-4 py-3 pr-12 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-[#FF7A00]">
                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 mt-6">
                <button type="submit" class="w-full px-6 py-3 rounded-xl bg-gradient-to-r from-[#FF7A00] to-[#FF9933] text-white font-semibold text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
