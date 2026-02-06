<a href="{{ $url }}" class="relative block group overflow-hidden rounded-lg shadow-lg">

    <img src="./storage/{{ $image }}" alt="{{ $title }}"
        class="w-full h-96 object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">

    <div
        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/20 group-hover:from-black/80 group-hover:via-black/50 group-hover:to-black/30 transition-all duration-500">
    </div>

    <div class="absolute inset-0 flex flex-col items-center justify-center p-6">

        <h2 class="text-white text-3xl md:text-4xl font-bold uppercase tracking-wider mb-3 transform group-hover:scale-110 transition-transform duration-500"
            style="text-shadow: 2px 4px 12px rgba(0,0,0,0.6);">
            {{ $title }}
        </h2>

        <div
            class="w-16 h-0.5 bg-white mb-4 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 delay-100">
        </div>

        <p class="text-white/90 text-sm md:text-base tracking-wide opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-200"
            style="text-shadow: 1px 2px 6px rgba(0,0,0,0.6);">
           {{ __('jd.view_all_collection') }}
        </p>

        <div
            class="mt-4 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-300">
            <svg class="w-6 h-6 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </div>
    </div>

    <div
        class="absolute inset-0 border-2 border-white/0 group-hover:border-white/30 transition-all duration-500 rounded-lg">
    </div>

    <div
        class="absolute top-4 left-4 w-2 h-2 bg-white/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
    </div>
    <div
        class="absolute top-4 right-4 w-2 h-2 bg-white/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
    </div>
    <div
        class="absolute bottom-4 left-4 w-2 h-2 bg-white/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-300">
    </div>
    <div
        class="absolute bottom-4 right-4 w-2 h-2 bg-white/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-400">
    </div>
</a>
