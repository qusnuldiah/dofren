@extends('admin.layouts.app')
@section('header_title', 'Promo N8N')
@section('content')

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="font-heading font-bold text-xl text-[#3D1A10]">Promo via N8N</h2>
        <p class="text-sm text-slate-400 mt-0.5">Promo ini disinkronkan otomatis dari engine n8n</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-2 text-xs text-slate-400 bg-slate-100 px-4 py-2.5 rounded-xl">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse inline-block"></span>
            Sinkronisasi Otomatis
        </div>
    </div>
</div>

<div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-white/60 overflow-hidden mb-6">
    @if(isset($promos) && $promos->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] text-left text-sm">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Platform</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Promo</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Diskon</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Berlaku s/d</th>
                        <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($promos as $promo)
                        @php
                            $platformColors = [
                                'GoFood'     => 'text-red-600 bg-red-50',
                                'GrabFood'   => 'text-green-600 bg-green-50',
                                'ShopeeFood' => 'text-orange-500 bg-orange-50',
                            ];
                            $pc = $platformColors[$promo->platform] ?? 'text-slate-600 bg-slate-100';
                        @endphp
                        <tr class="hover:bg-orange-50/30 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $pc }}">{{ $promo->platform }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $promo->title }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#FF7A00]">{{ $promo->discount_value ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $promo->valid_until ? \Carbon\Carbon::parse($promo->valid_until)->format('d M Y') : '∞' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $promo->is_active ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-400' }}">
                                    {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm">
                                <div class="flex justify-center">
                                    <button type="button" title="Hapus" @click="$dispatch('confirm-delete', '{{ route('admin.promos.destroy', $promo) }}')" class="p-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 transition-colors">
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
            {{ $promos->links() }}
        </div>
    @else
        <div class="py-16 text-center">
            <div class="flex justify-center mb-4 text-slate-400">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <p class="font-semibold text-[#3D1A10] mb-1">Belum ada promo dari n8n</p>
            <p class="text-sm text-slate-400 max-w-xs mx-auto">Promo akan muncul otomatis setelah n8n mengirimkan data melalui API endpoint <code class="bg-slate-100 px-2 py-0.5 rounded text-xs">/api/promos/sync</code></p>
        </div>
    @endif
</div>

{{-- API Info Card --}}
<div class="mt-6 bg-white/80 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-white/60">
    <p class="text-xs font-bold text-[#3D1A10] uppercase tracking-wider mb-3 flex items-center">
        <svg class="w-4 h-4 mr-2 text-[#FF7A00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
        Konfigurasi API Endpoint
    </p>
    <div class="space-y-2 text-sm text-slate-600">
        <div class="flex gap-2 items-start">
            <span class="font-mono bg-white px-2 py-0.5 rounded border text-xs text-slate-800 flex-shrink-0">POST</span>
            <code class="text-xs break-all">{{ config('app.url') }}/api/promos/sync</code>
        </div>
        <p class="text-xs text-slate-400">Header: <code class="bg-white px-1.5 py-0.5 rounded border text-xs">Authorization: Bearer {N8N_API_TOKEN}</code></p>
    </div>
</div>
@endsection
