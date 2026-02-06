<div class="group relative overflow-hidden bg-gray-50/50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700/50 rounded-xl shadow-sm hover:shadow-xl transition-all duration-500">
    <div class="relative overflow-hidden h-72 cursor-pointer" onclick="window.location.href='{{ route('produits.detail', $product->slug) }}'">
        <img src="{{ asset('storage/' . ($product->images->first()?->url ?? 'placeholder.jpg')) }}" 
             alt="{{ $product->name }}"
             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-all"></div>
    </div>
    
    <div class="p-5">
        <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-1 cursor-pointer hover:text-yellow-500 transition-colors"
            onclick="window.location.href='{{ route('produits.detail', $product->slug) }}'">
            {{ $product->name }}
        </h3>
        <p class="text-gray-500 dark:text-gray-400 font-medium mb-4 text-lg">
            ${{ number_format($product->price, 2) }}
        </p>
        
        <button onclick="addToCart(event, '{{ $product->slug }}', '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ asset('storage/' . ($product->images->first()?->url ?? 'placeholder.jpg')) }}')"
                class="w-full py-2.5 bg-gray-900 dark:bg-yellow-900 dark:hover:bg-yellow-500 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition-colors shadow-sm">
            {{ __('jd.add_to_cart') }}
        </button>
    </div>
</div>

<div id="toast" class="fixed top-24 -right-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-5 py-4 rounded-xl shadow-2xl transition-all duration-500 flex items-center gap-4 z-50 hidden">
    <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full">
        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <div class="flex flex-col">
        <p class="font-bold text-sm" id="toastMessage"></p>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('jd.prod_add_to_cart') }}</p>
    </div>
</div>


<script>
    function addToCart(event, productSlug, productName, productPrice, productImage) {
        event.stopPropagation();

        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        const existingItem = wishlist.find(item => item.slug === productSlug);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            wishlist.push({
                slug: productSlug,
                name: productName,
                price: parseFloat(productPrice),
                image: productImage,
                quantity: 1
            });
        }

        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        showToast(productName);
    }

    function showToast(productName) {
        const toast = document.getElementById('toast');
        const message = document.getElementById('toastMessage');

        message.textContent = productName;

        // Afficher et animer
        toast.classList.remove('hidden', '-right-full');
        toast.classList.add('flex', 'right-6');

        setTimeout(() => {
            // Cacher et réinitialiser
            toast.classList.remove('right-6');
            toast.classList.add('-right-full');

            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 300);
        }, 3000);
    }
</script>