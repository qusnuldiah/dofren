@props(['image', 'title', 'price', 'description' => null, 'badge' => null])

<div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 overflow-hidden border border-transparent hover:border-orange-100 flex flex-col h-full group">

    <!-- Image Container: Compact fixed height, never stretches -->
    <div class="relative overflow-hidden bg-slate-100">
        <img 
            src="{{ $image }}" 
            alt="{{ $title }}"
            class="h-48 w-full object-cover rounded-t-2xl group-hover:scale-105 transition-transform duration-500 ease-in-out"
            loading="lazy"
        >
        @if($badge)
            <div class="absolute top-3 left-3 bg-[#FF7A00] text-white text-[10px] font-bold tracking-wide px-2.5 py-1 rounded-full shadow">
                {{ $badge }}
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="font-heading font-bold text-base text-[#3D1A10] mb-1 line-clamp-1 leading-snug">{{ $title }}</h3>
        
        @if($description)
            <p class="text-xs text-slate-400 leading-relaxed line-clamp-2 flex-grow mb-3">{{ $description }}</p>
        @else
            <div class="flex-grow mb-3"></div>
        @endif

        <div class="pt-3 border-t border-slate-50 flex items-center justify-between mt-auto">
            <span class="font-bold text-base text-[#FF7A00]">
                Rp {{ number_format($price, 0, ',', '.') }}
            </span>
            <button
                x-data
                @click="$dispatch('open-modal')"
                class="w-8 h-8 bg-[#FF7A00]/10 text-[#FF7A00] hover:bg-[#FF7A00] hover:text-white rounded-full flex items-center justify-center transition-colors focus:outline-none focus:ring-2 focus:ring-[#FF7A00] focus:ring-offset-1"
                aria-label="Pesan {{ $title }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>
