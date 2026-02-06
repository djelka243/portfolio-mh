<x-layouts.site :title="__('Achats souhaités')" :breadcrumbs="['accueil' => __('Accueil'), 'wishlist' => __('Achats souhaités')]">
    <div class="min-h-screen ">
        <!-- En-tête minimaliste -->
        <div class=" border-b border-gray-700">
            <div class="max-w-7xl mx-auto px-6 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold ">{{ __('jd.my_cart') }}</h1>
                        <p class="text-gray-500 mt-1" id="cartItemCount">0 {{ __('jd.items_count', ['count' => 0]) }}</p>
                    </div>
                    <a href="/" class="text-sm text-gray-600 hover:text-gray-900 dark:hover:text-gray-300 flex items-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        {{__('jd.continue_shopping')}}
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div id="wishlistContainer" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Liste produits (8 colonnes) -->
                <div class="lg:col-span-8">
                    <div class="space-y-4" id="wishlistItems">
                        <!-- Chargé dynamiquement -->
                    </div>
                </div>

                <!-- Sidebar résumé (4 colonnes) -->
                <div class="lg:col-span-4">
                    <div class="bg-gray-50 dark:bg-zinc-900 rounded-lg p-6 sticky top-6">
                        <h2 class="text-lg font-semibold  mb-6">{{ __('jd.order_summary') }}</h2>
                        
                        <!-- Totaux -->
                        <div class="space-y-3 pb-6 border-b border-gray-200">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-300">{{ __('jd.subtotal') }}</span>
                                <span class="font-medium ">$<span id="subtotal">0.00</span></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-300">{{ __('jd.shipping') }}</span>
                                <span class="font-medium text-green-600">{{ __('jd.liv') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-300">{{ __('jd.taxes') }}</span>
                                <span class="font-medium ">$0.00</span>
                            </div>
                        </div>

                        <div class="flex justify-between pt-6 mb-6">
                            <span class="text-base font-semibold ">{{ __('jd.total') }}</span>
                            <span class="text-2xl font-bold ">$<span id="total">0.00</span></span>
                        </div>

                        <!-- Bouton commander -->
                        <button onclick="checkout()" class="w-full bg-gray-900 dark:bg-yellow-900 text-white py-3.5 rounded-lg font-medium hover:bg-gray-800 transition-colors mb-3">
                            {{__('jd.checkout')}}
                        </button>

                        <p class="text-xs text-center text-gray-500">
                            {{ __('jd.or') }} <a href="/" class="underline hover:text-gray-700 dark:hover:text-gray-300">{{ __('jd.continue_shopping') }}</a>
                        </p>

                        <!-- Avantages -->
                        <div class="mt-8 pt-6 border-t border-gray-200 space-y-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium ">{{ __('jd.free_shipping') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('jd.free_delivery_description') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium ">{{ __('jd.easy_returns') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('jd.easy_returns_description') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panier vide -->
            <div id="emptyMessage" class="hidden text-center py-24">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Votre panier est vide</h2>
                    <p class="text-gray-500 mb-8">Commencez vos achats dès maintenant</p>
                    <a href="/" class="inline-block bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors">
                        {{ __('jd.discover_products') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Vue Rapide -->
    <div id="quickViewModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
        <div class="bg-white  rounded-lg max-w-3xl w-full max-h-[85vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b">
                <h2 class="text-xl font-semibold" id="quickViewTitle"></h2>
                <button onclick="closeQuickView()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <img id="quickViewImage" src="" alt="" class="w-full aspect-square object-cover rounded-lg bg-gray-100">
                    </div>
                    <div class="flex flex-col">
                        <div class="mb-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2" id="quickViewCategory"></p>
                            <p class="text-3xl font-bold text-gray-900">$<span id="quickViewPrice">0</span></p>
                        </div>
                        <p id="quickViewDescription" class="text-gray-600 text-sm leading-relaxed mb-6"></p>
                        
                        <div class="mt-auto space-y-3">
                            <button onclick="addToWishlistFromModal()" class="w-full bg-gray-900 text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors">
                                {{ __('jd.add_to_cart') }}
                            </button>
                            <a id="quickViewDetailsBtn" href="#" class="block text-center text-sm text-gray-600 hover:text-gray-900">
                                Voir les détails complets
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Formulaire de Commande -->
<div id="checkoutModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200 sticky top-0 bg-white z-10 rounded-t-2xl">
            <h2 class="text-2xl font-bold text-gray-900">Finaliser ma commande</h2>
            <button onclick="closeCheckoutModal()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <!-- Form -->
        <form id="checkoutForm" class="p-6">
            @csrf
            <!-- Informations personnelles -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations personnelles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
                        <input type="text" name="prenom" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                        <input type="text" name="nom" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone *</label>
                        <input type="tel" name="telephone" required placeholder="+243 123 456 789"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Adresse de livraison -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Adresse de livraison</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adresse complète *</label>
                        <textarea name="adresse" required rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                                  placeholder="Numéro, rue, quartier..."></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ville *</label>
                            <input type="text" name="ville" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Code postal</label>
                            <input type="text" name="code_postal"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commentaire -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Commentaire (optionnel)</h3>
                <textarea name="commentaire" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                          placeholder="Instructions de livraison, préférences..."></textarea>
            </div>

            <!-- Résumé -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Résumé de la commande</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sous-total</span>
                        <span class="font-medium text-gray-900">$<span id="modalSubtotal">0.00</span></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Livraison</span>
                        <span class="font-medium text-green-600">Gratuite</span>
                    </div>
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-900">Total</span>
                            <span class="text-xl font-bold text-gray-900">$<span id="modalTotal">0.00</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex gap-3">
                <button type="button" onclick="closeCheckoutModal()"
                        class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    Annuler
                </button>
                <button type="submit" id="submitOrderBtn"
                        class="flex-1 px-6 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition-colors">
                    Confirmer la commande
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Toast notification (déjà existant, ajustez si nécessaire) -->
<div id="toast" class="fixed top-24 -right-full bg-gray-900 text-white px-6 py-4 rounded-lg shadow-2xl transition-all duration-300 items-center gap-3 z-50 hidden">
    <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <div>
        <p class="font-medium" id="toastMessage"></p>
        <p class="text-sm text-gray-300" id="toastSubMessage">Ajouté au panier</p>
    </div>
</div>

    <script>
        let currentQuickViewProduct = null;

        function loadWishlist() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const wishlistItems = document.getElementById('wishlistItems');
            const emptyMessage = document.getElementById('emptyMessage');
            const wishlistContainer = document.getElementById('wishlistContainer');
            const cartItemCount = document.getElementById('cartItemCount');

            const totalItems = wishlist.reduce((sum, item) => sum + item.quantity, 0);
            cartItemCount.textContent = `${totalItems} article${totalItems > 1 ? 's' : ''}`;

            if (wishlist.length === 0) {
                wishlistContainer.classList.add('hidden');
                emptyMessage.classList.remove('hidden');
                return;
            }

            wishlistContainer.classList.remove('hidden');
            emptyMessage.classList.add('hidden');
            wishlistItems.innerHTML = '';
            
            let total = 0;

            wishlist.forEach(item => {
                const subtotal = item.price * item.quantity;
                total += subtotal;

                const card = document.createElement('div');
                card.className = 'bg-gray-50 dark:bg-zinc-900 dark:text-gray-300 rounded-lg p-4 flex gap-4 hover:shadow-md transition-shadow';
                card.innerHTML = `
                    <div class="flex-shrink-0">
                        <img src="${item.image}" alt="${item.name}" class="w-24 h-24 object-cover rounded-lg bg-gray-100">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex-1 pr-4">
                                <h3 class="font-medium truncate">${item.name}</h3>
                            </div>
                            <button onclick="removeFromWishlist(${item.id})" class="text-gray-400 hover:text-red-600 transition-colors flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                        <div class="flex justify-between items-end">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center border border-gray-200 rounded-lg">
                                    <button onclick="updateQuantity(${item.id}, -1)" class="md:p-2 hover:bg-gray-50 transition-colors">
                                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <span class="px-4 text-sm font-medium text-gray-900 dark:text-gray-300">${item.quantity}</span>
                                    <button onclick="updateQuantity(${item.id}, 1)" class="p-2 hover:bg-gray-50 transition-colors">
                                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-200">× $${item.price.toFixed(2)}</span>
                            </div>
                            <p class="text-lg font-semibold">$${subtotal.toFixed(2)}</p>
                        </div>
                    </div>
                `;
                wishlistItems.appendChild(card);
            });

            document.getElementById('subtotal').textContent = total.toFixed(2);
            document.getElementById('total').textContent = total.toFixed(2);
        }

        function updateQuantity(productId, change) {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const item = wishlist.find(item => item.id === productId);
            
            if (item) {
                item.quantity += change;
                if (item.quantity < 1) {
                    removeFromWishlist(productId);
                    return;
                }
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                loadWishlist();
            }
        }

        function removeFromWishlist(productId) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            wishlist = wishlist.filter(item => item.id !== productId);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            loadWishlist();
        }

        function addToWishlist(event, productId, productName) {
            event.stopPropagation();
            
            fetch(`/produits/${productId}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const price = parseFloat(doc.querySelector('[data-price]')?.dataset.price) || 0;
                    const image = doc.querySelector('[data-image]')?.dataset.image || '';
                    
                    const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
                    const existingItem = wishlist.find(item => item.id === productId);

                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        wishlist.push({
                            id: productId,
                            name: productName,
                            price: price,
                            quantity: 1,
                            image: image
                        });
                    }

                    localStorage.setItem('wishlist', JSON.stringify(wishlist));
                });
        }

        function addToWishlistFromModal() {
            if (!currentQuickViewProduct) return;
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const existingItem = wishlist.find(item => item.id === currentQuickViewProduct.id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                wishlist.push({
                    id: currentQuickViewProduct.id,
                    name: currentQuickViewProduct.name,
                    price: currentQuickViewProduct.price,
                    quantity: 1,
                    image: currentQuickViewProduct.image
                });
            }

            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            closeQuickView();
            loadWishlist();
        }

        function openQuickView(event, product) {
            event.stopPropagation();
            currentQuickViewProduct = product;
            
            document.getElementById('quickViewTitle').textContent = product.name;
            document.getElementById('quickViewPrice').textContent = product.price.toFixed(2);
            document.getElementById('quickViewDescription').textContent = product.description || 'Pas de description disponible';
            document.getElementById('quickViewCategory').textContent = product.categorie?.name || 'Non catégorisé';
            
            const image = product.images && product.images.length > 0 ? 
                `/storage/${product.images[0].url}` : 
                'https://via.placeholder.com/400';
            document.getElementById('quickViewImage').src = image;
            document.getElementById('quickViewDetailsBtn').href = `/produits/${product.id}`;
            
            document.getElementById('quickViewModal').classList.remove('hidden');
            document.getElementById('quickViewModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeQuickView() {
            document.getElementById('quickViewModal').classList.add('hidden');
            document.getElementById('quickViewModal').classList.remove('flex');
            document.body.style.overflow = '';
        }

        function checkout() {
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        
        if (wishlist.length === 0) {
            showToast('Votre panier est vide', 'error');
            return;
        }

        // Calculer le total
        const total = wishlist.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        
        // Mettre à jour les totaux dans le modal
        document.getElementById('modalSubtotal').textContent = total.toFixed(2);
        document.getElementById('modalTotal').textContent = total.toFixed(2);
        
        // Ouvrir le modal
        document.getElementById('checkoutModal').classList.remove('hidden');
        document.getElementById('checkoutModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeCheckoutModal() {
        document.getElementById('checkoutModal').classList.add('hidden');
        document.getElementById('checkoutModal').classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Gérer la soumission du formulaire
    document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitOrderBtn');
        const originalText = submitBtn.textContent;
        
        // Désactiver le bouton et afficher un loader
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;
        
        const formData = new FormData(this);
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        const total = wishlist.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        
        // Ajouter les données du panier
        formData.append('total', total);
        formData.append('produits', JSON.stringify(wishlist));
        
        try {
            const csrfToken = document.querySelector('input[name="_token"]')?.value || '';
            
            const response = await fetch('/commandes', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                // Vider le panier
                localStorage.removeItem('wishlist');
                
                // Fermer le modal
                closeCheckoutModal();
                
                // Afficher un message de succès
                showToast('Commande confirmée !', 'success');
                
                // Proposer d'ouvrir WhatsApp
                if (confirm('Commande confirmée ! Voulez-vous confirmer aussi via WhatsApp ?')) {
                    window.open(data.whatsappLink, '_blank');
                }
                
                // Recharger la page après 2 secondes
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                throw new Error(data.message || 'Erreur lors de la commande');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showToast('Erreur lors de la commande: ' + error.message, 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        const toastSubMessage = document.getElementById('toastSubMessage');
        const icon = toast.querySelector('svg');
        
        toastMessage.textContent = message;
        
        if (type === 'success') {
            toastSubMessage.textContent = 'Succès';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>';
            icon.classList.remove('text-red-400');
            icon.classList.add('text-green-400');
        } else {
            toastSubMessage.textContent = 'Erreur';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
            icon.classList.remove('text-green-400');
            icon.classList.add('text-red-400');
        }
        
        toast.classList.remove('hidden', '-right-full');
        toast.classList.add('flex', 'right-6');
        
        setTimeout(() => {
            toast.classList.remove('right-6');
            toast.classList.add('-right-full');
            
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 300);
        }, 3000);
    }

    // Fermer le modal en cliquant à l'extérieur
    document.getElementById('checkoutModal').addEventListener('click', (e) => {
        if (e.target.id === 'checkoutModal') closeCheckoutModal();
    });

    // Fermer avec Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCheckoutModal();
            closeQuickView();
        }
    });

        loadWishlist();

        document.getElementById('quickViewModal').addEventListener('click', (e) => {
            if (e.target.id === 'quickViewModal') closeQuickView();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeQuickView();
        });
    </script>
</x-layouts.site>