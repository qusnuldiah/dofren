@extends('admin.layouts.app')
@section('header_title', 'Kelola Kategori')
@section('content')

<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
    <div class="flex items-center justify-between w-full lg:w-auto gap-2">
        <div>
            <h2 class="font-heading font-bold text-xl text-[#3D1A10]">Daftar Kategori</h2>
            <p class="text-sm text-slate-400 mt-0.5">Kelola kategori produk DoFren</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex lg:hidden items-center justify-center gap-1.5 bg-gradient-to-r from-[#FF7A00] to-[#FF9933] active:scale-95 text-white font-bold px-4 py-2 rounded-xl shadow-sm text-sm whitespace-nowrap transition-transform">
            + Tambah
        </a>
    </div>
    <div class="flex items-center gap-2 w-full lg:w-auto justify-end">
        <a href="{{ route('admin.categories.create') }}" class="hidden lg:inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#FF7A00] to-[#FF9933] hover:from-orange-600 hover:to-[#FF7A00] text-white font-bold px-5 py-2 rounded-xl shadow-[0_4px_15px_rgba(255,122,0,0.25)] hover:shadow-[0_6px_20px_rgba(255,122,0,0.4)] hover:-translate-y-0.5 transition-all text-sm whitespace-nowrap">
            + Tambah Kategori
        </a>
    </div>
</div>

<div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-white/60 overflow-hidden mb-6">
    @if($categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] text-left text-sm">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Produk</th>
                        <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($categories as $category)
                        <tr class="hover:bg-orange-50/30 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-orange-50 text-[#FF7A00]">
                                    {{ $category->products_count }} Produk
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" title="Edit" class="p-2 rounded-xl bg-slate-100 hover:bg-orange-50 hover:text-[#FF7A00] text-slate-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    
                                    <button type="button" title="Hapus" 
                                            onclick="confirmDeleteCategory('{{ route('admin.categories.destroy', $category) }}', {{ $category->products_count }})" 
                                            class="p-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="py-16 text-center">
            <div class="flex justify-center mb-4 text-[#FF7A00]">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <p class="font-semibold text-[#3D1A10] mb-1">Belum ada kategori</p>
            <p class="text-sm text-slate-400 mb-5">Silakan buat kategori pertama Anda untuk mengelompokkan produk.</p>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 bg-[#FF7A00] text-white font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-orange-600 transition-colors">
                + Tambah Kategori
            </a>
        </div>
    @endif
</div>

<!-- Special Warning Modal for Categories -->
<div x-data="{ show: false, url: '', productCount: 0 }" 
     @confirm-category-delete.window="show = true; url = $event.detail.url; productCount = $event.detail.count"
     x-show="show" 
     class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm"
     style="display: none;">
    <div @click.away="show = false" class="bg-white rounded-3xl p-6 shadow-2xl max-w-md w-full mx-4 border border-red-100" x-show="show" x-transition>
        <div class="flex items-start gap-4 mb-5">
            <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 mt-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h3 class="font-heading font-bold text-xl text-gray-900">Peringatan Keras!</h3>
                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                    Menghapus kategori ini juga akan <strong class="text-red-600">MENGHAPUS SEMUA PRODUK</strong> di dalamnya secara permanen.
                </p>
                <div x-show="productCount > 0" class="mt-3 inline-block px-3 py-1.5 bg-red-50 border border-red-200 rounded-lg text-sm font-semibold text-red-600">
                    ⚠️ Ada <span x-text="productCount"></span> produk di kategori ini yang akan ikut terhapus.
                </div>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-100">
            <button @click="show = false" type="button" class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors text-center">Batalkan</button>
            <form :action="url" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-md shadow-red-500/20 transition-all text-center">
                    Ya, Tetap Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDeleteCategory(url, count) {
        window.dispatchEvent(new CustomEvent('confirm-category-delete', {
            detail: { url: url, count: count }
        }));
    }
</script>

@endsection
