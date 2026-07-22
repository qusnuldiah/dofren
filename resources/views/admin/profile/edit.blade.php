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

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Password Baru</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter"
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
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
