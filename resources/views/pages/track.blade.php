@extends('layouts.app')

@section('title', 'Lacak Pesanan - DoFren Donut')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Page Header --}}
    <div class="text-center mb-8">
        <p class="text-[#FF7A00] text-xs font-bold tracking-widest uppercase mb-2">Status Pesanan</p>
        <h1 class="font-heading font-extrabold text-3xl text-[#3D1A10] mb-2">Lacak <span class="text-[#FF7A00]">Pesanan</span></h1>
        <p class="text-slate-500 text-sm">Masukkan nomor pesananmu untuk melihat status terkini.</p>
    </div>

    {{-- Search Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6">
        <form method="GET" action="{{ route('order.track') }}" class="flex gap-3">
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <input
                    type="text"
                    name="no_pesanan"
                    value="{{ request('no_pesanan') }}"
                    placeholder="Contoh: DF-2026-0001"
                    class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#FF7A00]/40 focus:border-[#FF7A00] uppercase tracking-wider text-sm transition-colors"
                >
            </div>
            <button type="submit" class="bg-[#FF7A00] hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-xl transition-colors shadow-md shadow-orange-200 flex-shrink-0">
                Cari
            </button>
        </form>
    </div>

    {{-- Result --}}
    @if(request('no_pesanan'))
        @if($order)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">

                {{-- Order Header --}}
                <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                    <div>
                        <p class="text-xs text-slate-400 mb-1">Nomor Pesanan</p>
                        <p class="text-2xl font-heading font-bold text-[#3D1A10]">{{ $order->order_number }}</p>
                    </div>
                    @php
                        $statusMap = [
                            'pending'    => ['label' => 'Menunggu', 'class' => 'bg-yellow-50 text-yellow-600'],
                            'confirmed'  => ['label' => 'Dikonfirmasi', 'class' => 'bg-blue-50 text-blue-600'],
                            'processing' => ['label' => 'Diproses', 'class' => 'bg-purple-50 text-purple-600'],
                            'ready'      => ['label' => 'Siap Diambil', 'class' => 'bg-green-50 text-green-600'],
                            'delivered'  => ['label' => 'Selesai', 'class' => 'bg-green-50 text-green-600'],
                            'cancelled'  => ['label' => 'Dibatalkan', 'class' => 'bg-red-50 text-red-500'],
                        ];
                        $sc = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'bg-slate-100 text-slate-500'];
                    @endphp
                    <span class="px-4 py-2 rounded-full text-sm font-bold {{ $sc['class'] }}">{{ $sc['label'] }}</span>
                </div>

                {{-- Status Timeline --}}
                @php
                    $steps = ['pending','confirmed','processing','ready','delivered'];
                    $stepLabels = ['Diterima','Dikonfirmasi','Diproses','Siap Diambil','Selesai'];
                    $currentIdx = array_search($order->status, $steps);
                @endphp
                <div class="mb-6">
                    @foreach($steps as $i => $step)
                        @php $done = $currentIdx !== false && $i <= $currentIdx && $order->status !== 'cancelled'; @endphp
                        <div class="flex items-center gap-4 {{ !$loop->last ? 'mb-3' : '' }}">
                            <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center text-base
                                        {{ $done ? 'bg-[#FF7A00] text-white' : 'bg-slate-100 text-slate-400' }}">
                            </div>
                            <div class="flex-1 flex items-center justify-between">
                                <span class="text-sm font-semibold {{ $done ? 'text-[#3D1A10]' : 'text-slate-400' }}">{{ $stepLabels[$i] }}</span>
                                @if($done && $i === $currentIdx)
                                    <span class="text-[10px] font-bold bg-[#FF7A00]/10 text-[#FF7A00] px-2 py-0.5 rounded-full">Sekarang</span>
                                @endif
                            </div>
                        </div>
                        @if(!$loop->last)
                            <div class="ml-5 w-0.5 h-3 {{ $done ? 'bg-[#FF7A00]' : 'bg-slate-200' }}"></div>
                        @endif
                    @endforeach
                </div>

                {{-- Order Details --}}
                <div class="bg-orange-50/50 rounded-xl p-4 mb-4 grid grid-cols-2 gap-3 text-sm">
                    <div><p class="text-xs text-slate-400 mb-0.5">Nama</p><p class="font-semibold text-[#3D1A10]">{{ $order->customer_name }}</p></div>
                    <div><p class="text-xs text-slate-400 mb-0.5">Cabang</p><p class="font-semibold text-[#3D1A10]">{{ $order->branch->name ?? '-' }}</p></div>
                    <div><p class="text-xs text-slate-400 mb-0.5">Tipe Order</p><p class="font-semibold text-[#3D1A10]">{{ ucfirst(str_replace('_',' ', $order->order_type)) }}</p></div>
                    <div><p class="text-xs text-slate-400 mb-0.5">Pembayaran</p><p class="font-semibold text-[#3D1A10]">{{ strtoupper($order->payment_method) }}</p></div>
                </div>

                {{-- Order Items --}}
                <h3 class="text-sm font-bold text-[#3D1A10] mb-3">Item Pesanan</h3>
                <div class="space-y-2 mb-4">
                    @foreach($order->items as $item)
                        <div class="flex justify-between text-sm py-2 border-b border-slate-100">
                            <span class="text-slate-700">{{ $item->product_name }} <span class="text-slate-400">×{{ $item->quantity }}</span></span>
                            <span class="font-semibold text-[#3D1A10]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="font-bold text-[#3D1A10]">Total</span>
                    <span class="text-xl font-extrabold text-[#FF7A00]">{{ $order->formatted_total }}</span>
                </div>
            </div>

        @else
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-10 text-center">
                <h2 class="font-heading font-bold text-xl text-[#3D1A10] mb-2">Pesanan Tidak Ditemukan</h2>
                <p class="text-slate-500 text-sm mb-6">
                    Nomor pesanan <strong>"{{ request('no_pesanan') }}"</strong> tidak ditemukan. Pastikan penulisan sudah benar.
                </p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-[#FF7A00] text-white font-bold py-3 px-6 rounded-xl hover:bg-orange-600 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    @else
        {{-- Empty state --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-10 text-center">
            <h2 class="font-heading font-semibold text-lg text-[#3D1A10] mb-2">Masukkan Nomor Pesanan</h2>
            <p class="text-slate-500 text-sm">Nomor pesanan kamu dikirim via WhatsApp / email setelah pesanan dikonfirmasi.</p>
        </div>
    @endif

</div>
@endsection
