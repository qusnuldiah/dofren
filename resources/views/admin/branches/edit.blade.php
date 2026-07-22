@extends('admin.layouts.app')
@section('header_title', 'Edit Cabang')
@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-sm border border-white/60">
        <h2 class="font-heading font-bold text-xl text-[#3D1A10] mb-6">Edit: {{ $branch->name }}</h2>

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

        <form action="{{ route('admin.branches.update', $branch) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Nama Cabang <span class="text-red-400">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $branch->name) }}" required
                           class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Kota <span class="text-red-400">*</span></label>
                    <input type="text" name="city" value="{{ old('city', $branch->city) }}" required
                           class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">No. Telepon <span class="text-red-400">*</span></label>
                    <input type="text" name="phone" value="{{ old('phone', $branch->phone) }}" required
                           class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Alamat Lengkap <span class="text-red-400">*</span></label>
                <textarea name="address" rows="2" required
                          class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors resize-none">{{ old('address', $branch->address) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Jam Operasional</label>
                <input type="text" name="open_hours" value="{{ old('open_hours', $branch->open_hours) }}"
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#3D1A10] mb-1.5">Link Google Maps</label>
                <input type="url" name="maps_embed" value="{{ old('maps_embed', $branch->maps_embed) }}"
                       class="w-full px-4 py-3 bg-gray-50/50 text-sm rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent outline-none transition-colors">
            </div>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $branch->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-[#FF7A00] focus:ring-[#FF7A00]">
                <span class="text-sm font-medium text-slate-600">Cabang Aktif / Buka</span>
            </label>

            <div class="flex gap-3 pt-6 border-t border-gray-100">
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FF7A00] to-[#FF9933] text-white font-semibold text-sm shadow-md hover:shadow-lg hover:scale-[1.02] transition-all">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.branches.index') }}" class="px-6 py-3 text-sm rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold flex items-center justify-center transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
