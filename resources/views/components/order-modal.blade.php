<!-- Modal/Bottom Sheet Backdrop -->
<div 
    x-data
    x-show="$store.modal.isOpen" 
    style="display: none;"
    class="fixed inset-0 z-50 flex items-end md:items-center justify-center bg-slate-900/40 backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.self="$store.modal.isOpen = false"
    @open-modal.window="$store.modal.isOpen = true"
>
    <!-- Modal Content: Bottom Sheet on Mobile, Centered Modal on Desktop -->
    <div 
        x-show="$store.modal.isOpen"
        class="w-full md:max-w-md bg-white rounded-t-3xl md:rounded-2xl shadow-2xl overflow-hidden relative"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full md:translate-y-8 md:scale-95 md:opacity-0"
        x-transition:enter-end="translate-y-0 md:translate-y-0 md:scale-100 md:opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 md:translate-y-0 md:scale-100 md:opacity-100"
        x-transition:leave-end="translate-y-full md:translate-y-8 md:scale-95 md:opacity-0"
    >
        <!-- Mobile Swipe Handle -->
        <div class="w-full flex justify-center pt-3 pb-1 md:hidden cursor-pointer" @click="$store.modal.isOpen = false">
            <div class="w-12 h-1.5 bg-slate-300 rounded-full"></div>
        </div>

        <div class="px-6 pt-4 pb-8 md:p-8">
            <!-- Header -->
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="font-heading font-bold text-2xl text-[#3D1A10]">Pesan Sekarang</h2>
                    <p class="text-sm text-slate-500 mt-1">Pilih layanan delivery favoritmu</p>
                </div>
                <!-- Close Button (Hidden on Mobile) -->
                <button @click="$store.modal.isOpen = false" class="hidden md:block text-slate-400 hover:text-slate-600 transition-colors p-1 rounded-full hover:bg-slate-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Delivery Options Grid -->
            <div class="space-y-4">
                <!-- GoFood -->
                <a href="{{ $platformLinks['link_gofood'] ?? '#' }}" 
                   target="{{ isset($platformLinks['link_gofood']) && $platformLinks['link_gofood'] ? '_blank' : '' }}"
                   class="flex items-center p-4 bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-xl hover:border-[#EE2737] transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-full bg-[#EE2737] flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300 shadow-sm text-white">
                        <svg class="w-7 h-7" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="7.5" stroke="currentColor" stroke-width="3" fill="none" />
                            <circle cx="12" cy="12" r="3.5" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-heading font-bold text-[#3D1A10] group-hover:text-[#EE2737] transition-colors">GoFood</h3>
                        <p class="text-xs text-slate-500">Pesan via aplikasi Gojek</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-hover:text-[#EE2737] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>

                <!-- GrabFood -->
                <a href="{{ $platformLinks['link_grabfood'] ?? '#' }}" 
                   target="{{ isset($platformLinks['link_grabfood']) && $platformLinks['link_grabfood'] ? '_blank' : '' }}"
                   class="flex items-center p-4 bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-xl hover:border-[#00B14F] transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-full bg-[#00B14F] flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300 shadow-sm text-white">
                        <span class="font-black italic tracking-tighter text-[15px] pr-0.5">Grab</span>
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-heading font-bold text-[#3D1A10] group-hover:text-[#00B14F] transition-colors">GrabFood</h3>
                        <p class="text-xs text-slate-500">Pesan via aplikasi Grab</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-hover:text-[#00B14F] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>

                <!-- ShopeeFood -->
                <a href="{{ $platformLinks['link_shopeefood'] ?? '#' }}" 
                   target="{{ isset($platformLinks['link_shopeefood']) && $platformLinks['link_shopeefood'] ? '_blank' : '' }}"
                   class="flex items-center p-4 bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-xl hover:border-[#EE4D2D] transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-full bg-[#EE4D2D] flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300 shadow-sm text-white">
                        <svg class="w-6 h-6 relative top-[-1px]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19,7h-3V6a4,4,0,0,0-8,0V7H5A2,2,0,0,0,3,9V21a2,2,0,0,0,2,2H19a2,2,0,0,0,2-2V9A2,2,0,0,0,19,7ZM10,6a2,2,0,0,1,4,0V7H10ZM19,21H5V9H8v2a1,1,0,0,0,2,0V9h4v2a1,1,0,0,0,2,0V9h3Z"/>
                            <text x="12" y="18" font-family="Arial, sans-serif" font-weight="900" font-size="8" fill="#EE4D2D" text-anchor="middle">S</text>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-heading font-bold text-[#3D1A10] group-hover:text-[#EE4D2D] transition-colors">ShopeeFood</h3>
                        <p class="text-xs text-slate-500">Pesan via aplikasi Shopee</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-hover:text-[#EE4D2D] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>

                <!-- WhatsApp Business -->
                <a href="{{ $platformLinks['link_whatsapp'] ?? '#' }}" 
                   target="{{ isset($platformLinks['link_whatsapp']) && $platformLinks['link_whatsapp'] ? '_blank' : '' }}"
                   class="flex items-center p-4 bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-xl hover:border-[#25D366] transition-all duration-300 group">
                    <div class="w-12 h-12 rounded-full bg-[#25D366] flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300 shadow-sm text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 2C6.491 2 2 6.49 2 12.031a10.02 10.02 0 001.341 5.01L2 22l5.105-1.336a10.04 10.04 0 004.926 1.286c5.54 0 10.031-4.49 10.031-10.031S17.571 2 12.031 2zm5.077 14.471c-.212.597-1.229 1.15-1.688 1.226-.459.076-1.036.195-3.327-.75-2.753-1.135-4.526-3.953-4.662-4.136-.135-.183-1.115-1.488-1.115-2.837 0-1.348.706-2.012.96-2.285.253-.274.55-.343.734-.343.183 0 .367.003.52.008.163.006.38-.065.594.455.214.52.735 1.79.801 1.921.066.132.11.286.027.452-.083.167-.124.271-.248.416-.123.146-.263.323-.374.453-.122.143-.25.3-.11.542.14.242.622 1.031 1.334 1.666.917.818 1.696 1.074 1.936 1.19.241.116.382.096.527-.07.145-.167.622-.727.788-.976.167-.25.333-.208.55-.125.217.083 1.378.65 1.614.767.237.118.396.177.454.276.059.098.059.57-.153 1.167z"/>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-heading font-bold text-[#3D1A10] group-hover:text-[#25D366] transition-colors">WhatsApp</h3>
                        <p class="text-xs text-slate-500">Pesan langsung ke WA Admin</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-hover:text-[#25D366] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
