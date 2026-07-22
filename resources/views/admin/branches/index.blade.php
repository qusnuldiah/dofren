@extends('admin.layouts.app')
@section('header_title', 'Lokasi Cabang')
@section('content')

<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="font-heading font-bold text-xl text-[#3D1A10]">Daftar Cabang</h2>
        <p class="text-sm text-slate-400 mt-0.5 hidden sm:block">Kelola lokasi gerai DoFren Donut</p>
    </div>
    <a href="{{ route('admin.branches.create') }}" class="inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-gradient-to-r from-[#FF7A00] to-[#FF9933] active:scale-95 text-white font-bold px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl shadow-sm sm:shadow-[0_4px_15px_rgba(255,122,0,0.25)] hover:shadow-[0_6px_20px_rgba(255,122,0,0.4)] hover:-translate-y-0.5 transition-all text-sm whitespace-nowrap">
        + Tambah
    </a>
</div>

<div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-white/60 overflow-hidden mb-6">
    @if($branches->count() > 0)
        <div class="divide-y divide-slate-50">
            @foreach($branches as $branch)
                <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between hover:bg-orange-50/30 transition-colors gap-4">
                    <div class="flex items-start sm:items-center gap-4 flex-1 min-w-0">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF7A00] flex items-center justify-center flex-shrink-0 mt-1 sm:mt-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-[#3D1A10] text-base">{{ $branch->name }}</p>
                            <p class="text-sm text-slate-500 truncate">{{ $branch->address }}, {{ $branch->city }}</p>
                            <div class="text-xs text-slate-400 flex flex-wrap items-center mt-1.5 gap-x-2 gap-y-1">
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    {{ $branch->phone }}
                                </span>
                                <span class="hidden sm:inline text-slate-300">•</span>
                                <span class="flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $branch->open_hours ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between sm:justify-end gap-3 flex-shrink-0 mt-3 sm:mt-0 pt-3 sm:pt-0 border-t border-gray-100 sm:border-0">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $branch->is_active ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-400' }}">
                            {{ $branch->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.branches.edit', $branch) }}" title="Edit" class="p-2 rounded-xl bg-slate-100 hover:bg-orange-50 hover:text-[#FF7A00] text-slate-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <button type="button" title="Hapus" @click="$dispatch('confirm-delete', '{{ route('admin.branches.destroy', $branch) }}')" class="p-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $branches->links() }}
        </div>
    @else
        <div class="py-16 text-center">
            <div class="flex justify-center mb-4 text-[#FF7A00]">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <p class="font-semibold text-[#3D1A10] mb-1">Belum ada cabang</p>
            <p class="text-sm text-slate-400 mb-5">Tambahkan lokasi gerai DoFren pertamamu!</p>
            <a href="{{ route('admin.branches.create') }}" class="inline-flex items-center gap-2 bg-[#FF7A00] text-white font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-orange-600 transition-colors">
                + Tambah Cabang Pertama
            </a>
        </div>
    @endif
</div>
@endsection
