@extends('admin.layouts.app')
@section('header_title', 'Tambah Kategori')
@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-sm border border-white/60">
        <h2 class="font-heading font-bold text-xl text-[#3D1A10] mb-6">Tambah Kategori Baru</h2>

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

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Nama Kategori <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Signature"
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
            </div>


            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Urutan (Opsional)</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                <p class="text-xs text-slate-400 mt-1">Gunakan angka untuk mengatur urutan tampil (contoh: 1, 2, 3).</p>
            </div>

            <div class="flex gap-3 pt-6 border-t border-gray-100">
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FF7A00] to-[#FF9933] text-white font-semibold text-sm shadow-md hover:shadow-lg hover:scale-[1.02] transition-all">
                    Simpan Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 text-sm rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold flex items-center justify-center transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
