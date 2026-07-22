@extends('admin.layouts.app')
@section('header_title', 'Edit Produk')
@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-sm border border-white/60">
        <h2 class="font-heading font-bold text-xl text-[#3D1A10] mb-6">Edit: {{ $product->name }}</h2>

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

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Nama Produk <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Kategori <span class="text-red-400">*</span></label>
                <select name="category_id" required class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors resize-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Harga (Rp) <span class="text-red-400">*</span></label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" step="500"
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Foto Produk</label>
                @if($product->image)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-100">
                        <p class="text-xs text-slate-400">Foto saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#FF7A00] hover:file:bg-orange-100 transition-colors">
            </div>

            <div class="flex gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_available" value="1" {{ old('is_available', $product->is_available) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-[#FF7A00] focus:ring-[#FF7A00]">
                    <span class="text-sm font-medium text-slate-600">Produk Tersedia</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller', $product->is_bestseller) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-[#FF7A00] focus:ring-[#FF7A00]">
                    <span class="text-sm font-medium text-slate-600">Bestseller</span>
                </label>
            </div>

            <div class="flex gap-3 pt-6 border-t border-gray-100">
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FF7A00] to-[#FF9933] text-white font-semibold text-sm shadow-md hover:shadow-lg hover:scale-[1.02] transition-all">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-sm rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold flex items-center justify-center transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
