<x-layouts.site title="FAQ">
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="/" class="text-gray-500 hover:text-gray-900 transition-colors">Accueil</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="font-medium text-gray-900">FAQ</span>
            </nav>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- En-tête -->
            <div class="text-center mb-12">
                <h1 style="font-family: 'Tangerine', cursive;" class="text-5xl md:text-6xl font-bold text-gray-900 mb-4">
                    Questions fréquentes
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Toutes les réponses dont vous avez besoin pour commander en toute sérénité
                </p>

                <!-- Barre de recherche -->
                <div class="relative mt-8 max-w-xl mx-auto">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input
                            id="search"
                            type="text"
                            placeholder="Rechercher une question…"
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-white shadow-sm
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   transition-all duration-200"
                        />
                        <button id="clear-search" class="absolute right-4 top-1/2 transform -translate-y-1/2 hidden">
                            <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Catégories -->
            <div class="flex justify-center flex-wrap gap-2 mb-10">
                <button data-category="all" 
                        class="category-btn active px-5 py-2.5 rounded-full text-sm font-medium
                               bg-blue-600 text-white shadow-sm hover:bg-blue-700 transition-colors">
                    Toutes les questions
                </button>
                <button data-category="commande"
                        class="category-btn px-5 py-2.5 rounded-full text-sm font-medium
                               bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
                    Commandes
                </button>
                <button data-category="livraison"
                        class="category-btn px-5 py-2.5 rounded-full text-sm font-medium
                               bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
                    Livraison
                </button>
                <button data-category="paiement"
                        class="category-btn px-5 py-2.5 rounded-full text-sm font-medium
                               bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
                    Paiement
                </button>
                <button data-category="produits"
                        class="category-btn px-5 py-2.5 rounded-full text-sm font-medium
                               bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
                    Produits
                </button>
            </div>

            <!-- Statistiques -->
            <div class="mb-8 text-center">
                <div class="inline-flex items-center space-x-6 bg-white px-6 py-3 rounded-full shadow-sm">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900" id="question-count">7</div>
                        <div class="text-xs text-gray-500">Questions</div>
                    </div>
                    <div class="h-8 w-px bg-gray-200"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">4</div>
                        <div class="text-xs text-gray-500">Catégories</div>
                    </div>
                </div>
            </div>

            <!-- Liste FAQ -->
            <div id="faq-list" class="space-y-4">
                <!-- Question 1 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" 
                     data-category="commande">
                    <button class="faq-question w-full px-6 py-5 text-left flex justify-between items-center 
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span class="font-medium text-gray-900">Comment passer commande sur votre site ?</span>
                        </div>
                        <svg class="icon w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 pb-5 hidden">
                        <div class="pl-8 border-l-2 border-blue-200">
                            <div class="space-y-3">
                                <p class="text-gray-700">Passer commande est très simple :</p>
                                <ol class="space-y-2 ml-4">
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-700 rounded-full text-sm font-bold mr-3">1</span>
                                        <span>Parcourez notre catalogue et ajoutez les produits à votre panier</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-700 rounded-full text-sm font-bold mr-3">2</span>
                                        <span>Cliquez sur le panier et vérifiez votre sélection</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-700 rounded-full text-sm font-bold mr-3">3</span>
                                        <span>Renseignez vos coordonnées (nom, adresse, téléphone)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-700 rounded-full text-sm font-bold mr-3">4</span>
                                        <span>Validez la commande - <strong>pas besoin de créer de compte !</strong></span>
                                    </li>
                                </ol>
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                    <p class="text-sm text-blue-700">
                                        <strong>À noter :</strong> Vous recevrez une confirmation par email et un suivi de commande.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" 
                     data-category="paiement">
                    <button class="faq-question w-full px-6 py-5 text-left flex justify-between items-center 
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium text-gray-900">Comment se passe le paiement ?</span>
                        </div>
                        <svg class="icon w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 pb-5 hidden">
                        <div class="pl-8 border-l-2 border-green-200">
                            <div class="space-y-3">
                                <p class="text-gray-700">
                                    Nous proposons un paiement simple et sécurisé : <strong>espèces à la livraison uniquement</strong>.
                                </p>
                                <div class="space-y-2">
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Payez en espèces directement au livreur</span>
                                    </div>
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Le montant exact est recommandé pour faciliter la transaction</span>
                                    </div>
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Vous recevez un reçu pour chaque paiement</span>
                                    </div>
                                </div>
                                <div class="mt-4 p-3 bg-green-50 rounded-lg">
                                    <p class="text-sm text-green-700">
                                        <strong>Important :</strong> Nous n'acceptons pas les paiements en ligne, les cartes bancaires ou les chèques.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" 
                     data-category="livraison">
                    <button class="faq-question w-full px-6 py-5 text-left flex justify-between items-center 
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="font-medium text-gray-900">Quels sont les délais et frais de livraison ?</span>
                        </div>
                        <svg class="icon w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 pb-5 hidden">
                        <div class="pl-8 border-l-2 border-purple-200">
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Délais de livraison :</h4>
                                    <ul class="space-y-2">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Zone urbaine : 24-48 heures</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Périphérie : 48-72 heures</span>
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Régions éloignées : 3-5 jours ouvrés</span>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Frais de livraison :</h4>
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <p class="text-purple-700">
                                            <strong>Livraison gratuite</strong> à partir de 50€ d'achat.<br>
                                            En dessous de ce montant : frais fixes de 4,90€.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" 
                     data-category="commande">
                    <button class="faq-question w-full px-6 py-5 text-left flex justify-between items-center 
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium text-gray-900">Puis-je modifier ou annuler ma commande ?</span>
                        </div>
                        <svg class="icon w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 pb-5 hidden">
                        <div class="pl-8 border-l-2 border-yellow-200">
                            <div class="space-y-4">
                                <p class="text-gray-700">
                                    Vous pouvez modifier ou annuler votre commande sous certaines conditions :
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span><strong>Modification :</strong> possible uniquement dans l'heure suivant la commande par email ou téléphone</span>
                                    </div>
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-yellow-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.698-.833-2.464 0L4.196 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        <span><strong>Annulation :</strong> possible jusqu'à 2 heures avant la préparation de la commande</span>
                                    </div>
                                </div>
                                <div class="mt-4 p-3 bg-yellow-50 rounded-lg">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Contactez-nous rapidement</strong> par téléphone au <strong>01 23 45 67 89</strong> 
                                        ou par email à <a href="mailto:contact@votresite.com" class="font-medium underline">contact@votresite.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" 
                     data-category="produits">
                    <button class="faq-question w-full px-6 py-5 text-left flex justify-between items-center 
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            <span class="font-medium text-gray-900">Que faire si je reçois un produit endommagé ?</span>
                        </div>
                        <svg class="icon w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 pb-5 hidden">
                        <div class="pl-8 border-l-2 border-red-200">
                            <div class="space-y-4">
                                <p class="text-gray-700">
                                    Si vous recevez un produit endommagé, suivez ces étapes :
                                </p>
                                <ol class="space-y-3 ml-4">
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-red-100 text-red-700 rounded-full text-sm font-bold mr-3">1</span>
                                        <span>Refusez la livraison ou notez "endommagé" sur le bon de livraison</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-red-100 text-red-700 rounded-full text-sm font-bold mr-3">2</span>
                                        <span>Prenez des photos du produit et de l'emballage</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-red-100 text-red-700 rounded-full text-sm font-bold mr-3">3</span>
                                        <span>Contactez-nous dans les 24 heures par email ou téléphone</span>
                                    </li>
                                </ol>
                                <div class="mt-4 p-3 bg-red-50 rounded-lg">
                                    <p class="text-sm text-red-700">
                                        <strong>Notre engagement :</strong> Nous vous enverrons un produit de remplacement 
                                        ou vous rembourserons intégralement.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 6 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" 
                     data-category="livraison">
                    <button class="faq-question w-full px-6 py-5 text-left flex justify-between items-center 
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="font-medium text-gray-900">Comment est organisée la livraison ?</span>
                        </div>
                        <svg class="icon w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 pb-5 hidden">
                        <div class="pl-8 border-l-2 border-indigo-200">
                            <div class="space-y-4">
                                <p class="text-gray-700">Notre processus de livraison :</p>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Vous recevez un SMS la veille de la livraison avec la plage horaire</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Le livreur vous appelle 30 minutes avant son arrivée</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Présentez-vous avec une pièce d'identité si nécessaire</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Vérifiez la commande avant de payer en espèces</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 7 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" 
                     data-category="produits">
                    <button class="faq-question w-full px-6 py-5 text-left flex justify-between items-center 
                                   hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-cyan-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                            </svg>
                            <span class="font-medium text-gray-900">Les produits sont-ils frais et de quelle origine ?</span>
                        </div>
                        <svg class="icon w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="faq-answer px-6 pb-5 hidden">
                        <div class="pl-8 border-l-2 border-cyan-200">
                            <div class="space-y-4">
                                <p class="text-gray-700">
                                    Nous garantissons la qualité et la fraîcheur de tous nos produits :
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-cyan-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-cyan-800 mb-2">Fraîcheur</h4>
                                        <ul class="text-sm text-cyan-700 space-y-1">
                                            <li>• Préparation le jour de la livraison</li>
                                            <li>• Chaîne du froid respectée</li>
                                            <li>• Dates limites de consommation vérifiées</li>
                                        </ul>
                                    </div>
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="font-semibold text-green-800 mb-2">Origine</h4>
                                        <ul class="text-sm text-green-700 space-y-1">
                                            <li>• 100% produits français</li>
                                            <li>• Producteurs locaux privilégiés</li>
                                            <li>• Traçabilité garantie</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aucun résultat -->
            <div id="no-results" class="hidden text-center py-12">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune question trouvée</h3>
                <p class="text-gray-600 mb-6">Essayez d'autres mots-clés ou contactez-nous directement</p>
                <a href="/contact" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-lg 
                                          hover:bg-blue-700 transition-colors text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Nous contacter
                </a>
            </div>

            <!-- Appel à l'action -->
            <div class="mt-16 pt-12 border-t border-gray-200 text-center">
                <h2 class="text-2xl font-semibold text-gray-900 mb-3">
                    Vous n'avez pas trouvé la réponse ?
                </h2>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Notre équipe est disponible du lundi au vendredi de 9h à 18h pour répondre à toutes vos questions.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contact"
                       class="inline-flex items-center justify-center px-6 py-3 bg-gray-900 text-white 
                              font-medium rounded-lg hover:bg-gray-400 transition-colors shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Nous écrire
                    </a>
                    <a href="tel:+243821525578"
                       class="inline-flex items-center justify-center px-6 py-3 bg-white text-gray-700 
                              font-medium rounded-lg hover:bg-gray-50 transition-colors border border-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        0821525578 
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Éléments DOM
            const faqItems = document.querySelectorAll('.faq-item');
            const searchInput = document.getElementById('search');
            const clearSearchBtn = document.getElementById('clear-search');
            const categoryBtns = document.querySelectorAll('.category-btn');
            const noResults = document.getElementById('no-results');
            const questionCount = document.getElementById('question-count');
            
            let activeCategory = 'all';
            let searchTerm = '';
            
            // Mettre à jour le compteur initial
            updateQuestionCount();
            
            // Fonction pour mettre à jour le compteur
            function updateQuestionCount() {
                const visibleItems = document.querySelectorAll('.faq-item:not(.hidden)').length;
                questionCount.textContent = visibleItems;
            }
            
            // Gestion des questions FAQ
            faqItems.forEach(item => {
                const questionBtn = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = questionBtn.querySelector('.icon');
                
                questionBtn.addEventListener('click', () => {
                    // Fermer les autres questions
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                            otherItem.querySelector('.faq-answer').classList.add('hidden');
                            otherItem.querySelector('.icon').classList.remove('rotate-180');
                        }
                    });
                    
                    // Basculer l'état actuel
                    item.classList.toggle('open');
                    answer.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            });
            
            // Recherche
            searchInput.addEventListener('input', function() {
                searchTerm = this.value.toLowerCase().trim();
                
                // Afficher/masquer le bouton de suppression
                if (searchTerm.length > 0) {
                    clearSearchBtn.classList.remove('hidden');
                } else {
                    clearSearchBtn.classList.add('hidden');
                }
                
                filterQuestions();
            });
            
            // Effacer la recherche
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                searchTerm = '';
                this.classList.add('hidden');
                searchInput.focus();
                filterQuestions();
            });
            
            // Filtrage par catégorie
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Mettre à jour les boutons actifs
                    categoryBtns.forEach(b => b.classList.remove('active', 'bg-blue-600', 'text-white'));
                    this.classList.add('active', 'bg-blue-600', 'text-white');
                    this.classList.remove('bg-white', 'text-gray-700', 'border');
                    
                    // Mettre à jour la catégorie active
                    activeCategory = this.dataset.category;
                    
                    filterQuestions();
                });
            });
            
            // Fonction principale de filtrage
            function filterQuestions() {
                let visibleCount = 0;
                
                faqItems.forEach(item => {
                    const questionText = item.querySelector('.faq-question span').textContent.toLowerCase();
                    const answerText = item.querySelector('.faq-answer').textContent.toLowerCase();
                    const category = item.dataset.category;
                    
                    // Vérifier les correspondances
                    const matchesSearch = searchTerm === '' || 
                                          questionText.includes(searchTerm) || 
                                          answerText.includes(searchTerm);
                    const matchesCategory = activeCategory === 'all' || category === activeCategory;
                    
                    if (matchesSearch && matchesCategory) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                        item.classList.remove('open');
                        item.querySelector('.faq-answer').classList.add('hidden');
                        item.querySelector('.icon').classList.remove('rotate-180');
                    }
                });
                
                // Afficher/masquer le message "aucun résultat"
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
                
                // Mettre à jour le compteur
                updateQuestionCount();
            }
            
            // Ouvrir la première question par défaut
            if (faqItems.length > 0) {
                const firstItem = faqItems[0];
                firstItem.classList.add('open');
                firstItem.querySelector('.faq-answer').classList.remove('hidden');
                firstItem.querySelector('.icon').classList.add('rotate-180');
            }
        });
    </script>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
        .faq-answer {
            transition: all 0.3s ease;
        }
        .category-btn.active {
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }
    </style>
</x-layouts.site>