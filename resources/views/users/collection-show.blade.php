<x-layouts.site :title="$categorie->name">
    <!-- Breadcrumb -->
    <div class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="/" class="text-gray-500 hover:text-gray-900">{{__('jd.home')}}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('collections.index') }}" class="text-gray-500 ">{{__('jd.collections')}}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class=" font-medium">{{ $categorie->name }}</span>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 dark:bg-zinc-900 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <h1 class="text-4xl md:text-5xl font-bold  mb-4">{{ $categorie->name }}</h1>
            <p class="text-lg ">{{ $categorie->produits->count() }} {{__('jd.products_available')}}</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($categorie->produits as $product)
                <x-site.product-card :product="$product" />
            @endforeach
        </div>
    </div>
</x-layouts.site>