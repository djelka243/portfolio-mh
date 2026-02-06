<x-layouts.site title="Collections">
    <x-site.section-title title="Nos Collections" />

    <div class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="/" class="text-gray-500 hover:text-gray-900">{{ __('jd.home') }}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class=" font-medium">{{ __('jd.accessories') }}</span>
            </div>
        </div>
    </div>



    <div class="bg-gray-50 dark:bg-zinc-900 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <h1 class="text-4xl md:text-5xl font-bold  mb-4">{{ __('jd.accessories') }}</h1>
            <p class="text-lg ">{{ $accessoires->total() }} {{ __('jd.products_available') }}</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($accessoires as $accessoire)
                <x-site.product-card :product="$accessoire" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $accessoires->links() }}
        </div>
    </div>


</x-layouts.site>
