@extends('admin.layouts.app')
@section('header_title', 'Menu & Harga')
@section('content')

<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
    <div class="flex items-center justify-between w-full lg:w-auto gap-2">
        <div>
            <h2 class="font-heading font-bold text-xl text-[#3D1A10]">Daftar Produk</h2>
            <p class="text-sm text-slate-400 mt-0.5">Kelola produk DoFren</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex lg:hidden items-center justify-center gap-1.5 bg-gradient-to-r from-[#FF7A00] to-[#FF9933] active:scale-95 text-white font-bold px-4 py-2 rounded-xl shadow-sm text-sm whitespace-nowrap transition-transform">
            + Tambah
        </a>
    </div>
    <div class="flex items-center gap-2 w-full lg:w-auto">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-row items-center gap-2 w-full">
            <div class="relative group flex-1 w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari donat..." oninput="if(this.value === '') this.form.submit()" onsearch="this.form.submit()" class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 outline-none focus:ring-2 focus:ring-[#FF7A00]/20 focus:border-[#FF7A00] transition-all shadow-sm">
            </div>
            
            <div class="relative w-[140px] sm:w-48 flex-shrink-0">
                <select name="category" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 outline-none focus:ring-2 focus:ring-[#FF7A00]/20 focus:border-[#FF7A00] transition-all shadow-sm appearance-none cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            <button type="submit" class="hidden"></button>
        </form>
        <a href="{{ route('admin.products.create') }}" class="hidden lg:inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#FF7A00] to-[#FF9933] hover:from-orange-600 hover:to-[#FF7A00] text-white font-bold px-5 py-2 rounded-xl shadow-[0_4px_15px_rgba(255,122,0,0.25)] hover:shadow-[0_6px_20px_rgba(255,122,0,0.4)] hover:-translate-y-0.5 transition-all text-sm whitespace-nowrap">
            + Tambah
        </a>
    </div>
</div>

<div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-white/60 overflow-hidden mb-6">
    @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] text-left text-sm">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($products as $product)
                        <tr class="hover:bg-orange-50/30 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-100" alt="Product Image">
                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            @if(request('search'))
                                                {!! preg_replace('/(' . preg_quote(request('search'), '/') . ')/i', '<span class="text-[#FF7A00] font-black">$1</span>', e($product->name)) !!}
                                            @else
                                                {{ $product->name }}
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500 line-clamp-1">{{ $product->description }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#FF7A00] whitespace-nowrap">{{ $product->formatted_price }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $product->is_available ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-400' }}">
                                    {{ $product->is_available ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" title="Edit" class="p-2 rounded-xl bg-slate-100 hover:bg-orange-50 hover:text-[#FF7A00] text-slate-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <button type="button" title="Hapus" @click="$dispatch('confirm-delete', '{{ route('admin.products.destroy', $product) }}')" class="p-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $products->links() }}
        </div>
    @else
        <div class="py-16 text-center">
            <div class="flex justify-center mb-4 text-[#FF7A00]">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <p class="font-semibold text-[#3D1A10] mb-1">Belum ada produk</p>
            <p class="text-sm text-slate-400 mb-5">Mulai tambahkan produk menu DoFren pertamamu!</p>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-[#FF7A00] text-white font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-orange-600 transition-colors">
                + Tambah Produk Pertama
            </a>
        </div>
    @endif
</div>
@endsection
