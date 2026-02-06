<x-layouts.site :title="__('Achats souhaités')" :breadcrumbs="['accueil' => __('Accueil'), 'detail' => __('Détail du produit')]">

    <div class="min-h-screen">
        <!-- Breadcrumb -->
        <div class="border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center gap-2 text-sm">
                    <a href="/" class="text-gray-500 hover:text-gray-900">Accueil</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <a href="/collections" class="text-gray-500 hover:text-gray-900">Collections</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class=" font-medium">{{ $produit->categorie->name }}</span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class=" font-medium">{{ $produit->name }}</span>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Galerie images (sticky) -->
                <div class="space-y-4 lg:sticky lg:top-6 lg:self-start">
                    <!-- Image principale -->
                    <div class="aspect-square rounded-lg overflow-hidden cursor-zoom-in group"
                        onclick="openImageModal()">
                        <img id="mainImage"
                            src="{{ asset('storage/' . ($produit->images->first()?->url ?? 'placeholder.jpg')) }}"
                            alt="{{ $produit->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/10">
                            <div class=" rounded-full p-3 shadow-lg">
                                <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Miniatures -->
                    @if ($produit->images->count() > 1)
                        <div class="grid grid-cols-4 gap-3">
                            @foreach ($produit->images as $image)
                                <button onclick="changeMainImage('{{ asset('storage/' . $image->url) }}')"
                                    class="aspect-square bg-gray-50 rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-900 transition-all">
                                    <img src="{{ asset('storage/' . $image->url) }}" alt="miniature"
                                        class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Informations produit (scrollable) -->
                <div class="flex flex-col">
                    <!-- En-tête -->
                    <div class="mb-8">
                        <p class="text-sm  uppercase tracking-wider mb-3">{{ $produit->categorie->name }}
                        </p>
                        <h1 class="text-4xl font-bold mb-4">{{ $produit->name }}</h1>

                        <!-- Prix -->
                        <div class="flex items-baseline gap-3">
                            <span
                                class="text-3xl font-bold">${{ number_format($produit->price, 2) }}</span>
                            @if ($produit->reduction)
                                <span
                                    class="text-lg  line-through">${{ number_format($produit->price / (1 - $produit->reduction / 100), 2) }}</span>
                                <span
                                    class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm font-medium">-{{ $produit->reduction }}%</span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-lg font-semibold mb-4">Description</h2>
                        <div class="text-gray-600 leading-relaxed prose prose-sm max-w-none">
                            {!! $produit->description !!}
                        </div>
                    </div>

                    <!-- Détails -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-lg font-semibold  mb-4">Détails</h2>
                        <dl class="space-y-3">
                            @if ($produit->taille)
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Taille</dt>
                                    <dd class="font-medium ">{{ $produit->taille }}</dd>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <dt class="">Disponibilité</dt>
                                <dd class="font-medium text-green-600">En stock</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-4 mb-8">
                        <button
                            onclick="addToCart({{ $produit->id }}, '{{ addslashes($produit->name) }}', {{ $produit->price }}, '{{ asset('storage/' . ($produit->images->first()?->url ?? 'default.jpg')) }}')"
                            class="w-full bg-gray-900 dark:bg-yellow-900 text-white py-4 rounded-lg font-medium">
                            Ajouter au panier
                        </button>

                        <div class="">
                            <a href="/wishlist"
                                class="flex items-center justify-center gap-2 py-3 border border-gray-300 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span class="text-sm font-medium">Voir panier</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @php
            $produitsSimilaires = \App\Models\Produit::where('categorie_id', $produit->categorie_id)
                ->where('id', '!=', $produit->id)
                ->with(['images', 'categorie'])
                ->limit(4)
                ->get();
        @endphp

        @if ($produitsSimilaires->count() > 0)
            <div class="border-t border-gray-200 bg-gray-50 dark:bg-gray-900 py-16">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold ">Vous aimerez aussi</h2>
                        <a href="/collections/{{ $produit->categorie->slug ?? $produit->categorie->id }}"
                            class="text-sm hover:text-yellow-700 flex items-center gap-1">
                            Voir tout
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($produitsSimilaires as $similar)
                            <a href="/produit/detail/{{ $similar->slug }}"
                                class="group bg-white rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                <div class="aspect-square bg-gray-100 overflow-hidden">
                                    <img src="{{ asset('storage/' . ($similar->images->first()?->url ?? 'placeholder.jpg')) }}"
                                        alt="{{ $similar->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-4">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">
                                        {{ $similar->categorie->name }}</p>
                                    <h3 class="font-medium text-gray-900 mb-2 line-clamp-2">{{ $similar->name }}</h3>
                                    <div class="flex items-baseline gap-2">
                                        <span
                                            class="font-bold text-gray-900">${{ number_format($similar->price, 2) }}</span>
                                        @if ($similar->reduction)
                                            <span
                                                class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded">-{{ $similar->reduction }}%</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal zoom image -->
    <div id="imageModal" class="fixed inset-0 bg-black/95 hidden items-center justify-center z-50 p-4"
        onclick="closeImageModal()">
        <button class="absolute top-6 right-6 text-white hover:text-gray-300 transition-colors"
            onclick="closeImageModal()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="max-w-6xl max-h-full" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="Zoom"
                class="max-w-full max-h-[90vh] object-contain rounded-lg">
        </div>
        <!-- Navigation entre images (si plusieurs) -->
        @if ($produit->images->count() > 1)
            <button onclick="event.stopPropagation(); previousImage()"
                class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white p-3 rounded-full transition-colors backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="event.stopPropagation(); nextImage()"
                class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 text-white p-3 rounded-full transition-colors backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @endif
    </div>

    <!-- Toast notification -->
    <div id="toast"
        class="fixed top-24 -right-full bg-gray-900 text-white px-6 py-4 rounded-lg shadow-2xl transition-all duration-300 items-center gap-3 z-50 hidden">
        <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <div>
            <p class="font-medium" id="toastMessage"></p>
            <p class="text-sm text-gray-300">Ajouté au panier</p>
        </div>
    </div>

    <script>
        // Images disponibles
        const productImages = [
            @foreach ($produit->images as $image)
                "{{ asset('storage/' . $image->url) }}",
            @endforeach
        ];
        let currentImageIndex = 0;

        function changeMainImage(imageSrc) {
            document.getElementById('mainImage').src = imageSrc;
            currentImageIndex = productImages.indexOf(imageSrc);
        }

        function openImageModal() {
            const mainImage = document.getElementById('mainImage').src;
            document.getElementById('modalImage').src = mainImage;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.body.style.overflow = '';
        }

        function previousImage() {
            currentImageIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
            const newImage = productImages[currentImageIndex];
            document.getElementById('mainImage').src = newImage;
            document.getElementById('modalImage').src = newImage;
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % productImages.length;
            const newImage = productImages[currentImageIndex];
            document.getElementById('mainImage').src = newImage;
            document.getElementById('modalImage').src = newImage;
        }

        function addToCart(productId, productName, productPrice, productImage) {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const existingItem = wishlist.find(item => item.id === productId);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                wishlist.push({
                    id: productId,
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
                }, 300); // Attendre la fin de l'animation
            }, 3000);
        }

        // Fermer modal avec touche Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeImageModal();
            } else if (e.key === 'ArrowLeft') {
                previousImage();
            } else if (e.key === 'ArrowRight') {
                nextImage();
            }
        });
    </script>
</x-layouts.site>
