<x-layouts.site title="Collections">
    <x-site.section-title title="Nos Collections" />

    <div class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="/" class="text-gray-500 hover:text-gray-900">{{__('jd.home')}}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class=" font-medium">{{__('jd.collections')}}</span>
            </div>
        </div>
    </div>

    @forelse ($categories as $categorie)
        @if ($categorie->produits->count() > 0)
            <section class="max-w-7xl mx-auto px-6 py-16" id="categorie-{{ $categorie->slug }}">
                
                <div class="mb-12 flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">{{ $categorie->name }}</h2>
                        <div class="w-16 h-1 bg-zinc-900 dark:bg-white"></div>
                    </div>
                    <a href="{{ route('collections.show', $categorie->slug) }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-gray-900 text-gray-900 font-medium rounded-lg hover:bg-yellow-900 hover:text-white transition-all duration-300">
                        <span>{{__('jd.view_all_collection')}}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <!-- Grille de produits -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" 
                     id="produits-grid-{{ $categorie->slug }}"
                     data-categorie-id="{{ $categorie->slug }}"
                     data-offset="8"
                     data-total="{{ $categorie->produits()->count() }}">
                    @foreach ($categorie->produits as $product)
                        <x-site.product-card :product="$product" />
                    @endforeach
                </div>

                @if($categorie->produits()->count() > 8)
                <div class="mt-12 text-center">
                    <button 
                        onclick="loadMoreProducts('{{ $categorie->slug }}')"
                        id="load-more-{{ $categorie->slug }}"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 dark:hover:bg-yellow-900">
                        <span>{{__('jd.view_more')}}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div id="loader-{{ $categorie->slug }}" class="hidden mt-8">
                        <div class="inline-flex items-center gap-3 text-gray-600">
                            <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>{{__('jd.loading')}}</span>
                        </div>
                    </div>
                </div>
                @endif
            </section>

            @if(!$loop->last)
            <div class="border-t border-gray-200"></div>
            @endif
        @endif
    @empty
        <div class="max-w-7xl mx-auto px-6 py-16">
            <p class="text-center text-gray-500 text-lg">
                {{__('jd.no_collections')}}
            </p>
        </div>
    @endforelse

    <script>
        async function loadMoreProducts(categorieId) {
            const grid = document.getElementById(`produits-grid-${categorieId}`);
            const button = document.getElementById(`load-more-${categorieId}`);
            const loader = document.getElementById(`loader-${categorieId}`);
            const offset = parseInt(grid.dataset.offset);

            // Afficher le loader, cacher le bouton
            button.classList.add('hidden');
            loader.classList.remove('hidden');

            try {
                const response = await fetch(`/collections/${categorieId}/load-more?offset=${offset}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.message || 'Erreur lors du chargement');
                }

                data.produits.forEach(produit => {
                    const productCard = createProductCard(produit);
                    grid.insertAdjacentHTML('beforeend', productCard);
                });

                grid.dataset.offset = data.newOffset;

                if (data.hasMore) {
                    button.classList.remove('hidden');
                } else {
                    button.outerHTML = `
                        <p class="text-gray-500 text-sm font-medium">
                            {{__('jd.all_products_loaded')}}
                        </p>
                    `;
                }
            } catch (error) {
                console.error('Erreur lors du chargement:', error);
                button.classList.remove('hidden');
                
                const errorDiv = document.createElement('div');
                errorDiv.className = 'mt-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm';
                errorDiv.textContent = `Erreur: ${error.message}`;
                button.parentElement.appendChild(errorDiv);
                
                setTimeout(() => errorDiv.remove(), 5000);
            } finally {
                loader.classList.add('hidden');
            }
        }

        function createProductCard(produit) {
            const reductionBadge = produit.reduction 
                ? `<div class="absolute top-4 left-4 bg-white px-3 py-1 text-xs font-semibold uppercase tracking-wider opacity-0 group-hover:opacity-100 transform -translate-y-2 group-hover:translate-y-0 transition-all duration-500">
                        -${produit.reduction}%
                   </div>`
                : '';

            return `
                <div class="group relative overflow-hidden bg-white rounded-lg shadow-sm hover:shadow-xl transition-shadow duration-500">
                    <div class="relative overflow-hidden">
                        <a href="${produit.url}">
                            <img src="/storage/${produit.image}" 
                                 alt="${produit.name}"
                                 class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
                        </a>
                        
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-500"></div>
                        
                        ${reductionBadge}
                        
                       
                    </div>
                    
                    <div class="p-4 text-center">
                        <a href="${produit.url}">
                            <h3 class="font-semibold text-gray-900 mb-1 group-hover:text-gray-700 transition-colors duration-300">
                                ${produit.name}
                            </h3>
                        </a>
                        <p class="text-sm text-gray-600 font-medium">$${produit.price.toFixed(2)}</p>
                        
                        <button onclick="addToCart(event, ${produit.id}, '${produit.name.replace(/'/g, "\\'")}', ${produit.price}, '/storage/${produit.image}')" 
                                class="mt-4 w-full py-2.5 bg-gray-900 text-white text-sm font-medium uppercase tracking-wider opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-500 hover:bg-gray-800">
                            {{__('jd.add_to_cart')}}
                        </button>
                    </div>
                    
                    <div class="absolute top-4 right-4 w-3 h-3 bg-green-500 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500" title="En stock"></div>
                </div>
            `;
        }

        // Fonction pour ajouter au panier
        function addToCart(event, productId, productName, productPrice, productImage) {
            event.preventDefault();
            event.stopPropagation();
            
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
            showNotification(`${productName} ajouté au panier!`);
        }

        function showNotification(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-24 right-6 bg-gray-900 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 z-50 animate-slide-in';
            toast.innerHTML = `
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <div>
                    <p class="font-medium">${message}</p>
                    <p class="text-sm text-gray-300">Ajouté au panier</p>
                </div>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>

    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>
</x-layouts.site>