<!-- Cookie Consent Banner -->
<div id="cookieConsent" class="hidden fixed inset-x-0 bottom-0 z-[100] pb-6 px-4 sm:px-6 lg:px-8 pointer-events-none">
    <div class="max-w-7xl mx-auto pointer-events-auto">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all duration-500 translate-y-0">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col lg:flex-row items-center gap-6">
                    <!-- Icon -->
                    <div class="flex-shrink-0 ">
                        <div class="w-48 md:w-32 md:h-full">
                            <img src="4.jpg" alt="logo du site">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            🍪 Nous utilisons des cookies
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Nous utilisons des cookies pour améliorer votre expérience de navigation, analyser le trafic du site et personnaliser le contenu. En cliquant sur "Tout accepter", vous consentez à notre utilisation des cookies.
                        </p>
                        <button onclick="toggleCookieDetails()" class="mt-3 text-sm font-medium text-gray-900 hover:text-gray-700 underline inline-flex items-center gap-1">
                            <span id="detailsToggleText">En savoir plus</span>
                            <svg id="detailsToggleIcon" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                        <button onclick="openCookieSettings()" 
                                class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-300 text-sm whitespace-nowrap">
                            Personnaliser
                        </button>
                        <button onclick="acceptAllCookies()" 
                                class="px-6 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl text-sm whitespace-nowrap">
                            Tout accepter
                        </button>
                    </div>
                </div>

                <!-- Détails (caché par défaut) -->
                <div id="cookieDetails" class="hidden mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Cookies essentiels -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Essentiels</h4>
                                <p class="text-xs text-gray-600">Nécessaires au fonctionnement du site. Toujours actifs.</p>
                            </div>
                        </div>

                        <!-- Cookies analytiques -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Analytiques</h4>
                                <p class="text-xs text-gray-600">Nous aident à comprendre comment vous utilisez notre site.</p>
                            </div>
                        </div>

                        <!-- Cookies marketing -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Marketing</h4>
                                <p class="text-xs text-gray-600">Utilisés pour vous proposer des publicités pertinentes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de personnalisation -->
<div id="cookieSettingsModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[101] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div class="sticky top-0 bg-white border-b border-gray-200 p-6 rounded-t-2xl z-10">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Paramètres des cookies</h2>
                <button onclick="closeCookieSettings()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- Description -->
            <p class="text-gray-600 leading-relaxed">
                Gérez vos préférences en matière de cookies. Vous pouvez activer ou désactiver différents types de cookies ci-dessous.
            </p>

            <!-- Cookie categories -->
            <div class="space-y-4">
                <!-- Essentiels (toujours actifs) -->
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Cookies essentiels</h3>
                                <p class="text-sm text-gray-600">Toujours actifs</p>
                            </div>
                        </div>
                        <div class="bg-green-500 rounded-full w-12 h-7 flex items-center px-1 pointer-events-none">
                            <div class="bg-white w-5 h-5 rounded-full shadow-sm ml-auto"></div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">
                        Ces cookies sont nécessaires au fonctionnement du site et ne peuvent pas être désactivés.
                    </p>
                </div>

                <!-- Analytiques -->
                <div class="bg-white rounded-xl p-5 border-2 border-gray-200 hover:border-blue-300 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Cookies analytiques</h3>
                                <p class="text-sm text-gray-600">Statistiques d'utilisation</p>
                            </div>
                        </div>
                        <button onclick="toggleCookie('analytics')" id="analyticsToggle" 
                                class="cookie-toggle bg-gray-300 rounded-full w-12 h-7 flex items-center px-1 transition-colors duration-300">
                            <div class="bg-white w-5 h-5 rounded-full shadow-sm transition-transform duration-300"></div>
                        </button>
                    </div>
                    <p class="text-sm text-gray-600">
                        Ces cookies nous aident à comprendre comment les visiteurs interagissent avec notre site web.
                    </p>
                </div>

                <!-- Marketing -->
                <div class="bg-white rounded-xl p-5 border-2 border-gray-200 hover:border-purple-300 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Cookies marketing</h3>
                                <p class="text-sm text-gray-600">Publicités personnalisées</p>
                            </div>
                        </div>
                        <button onclick="toggleCookie('marketing')" id="marketingToggle" 
                                class="cookie-toggle bg-gray-300 rounded-full w-12 h-7 flex items-center px-1 transition-colors duration-300">
                            <div class="bg-white w-5 h-5 rounded-full shadow-sm transition-transform duration-300"></div>
                        </button>
                    </div>
                    <p class="text-sm text-gray-600">
                        Ces cookies sont utilisés pour vous proposer des publicités pertinentes basées sur vos intérêts.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="sticky bottom-0 bg-gray-50 border-t border-gray-200 p-6 rounded-b-2xl flex gap-3">
            <button onclick="rejectAllCookies()" 
                    class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-white transition-all duration-300">
                Tout refuser
            </button>
            <button onclick="saveCustomCookies()" 
                    class="flex-1 px-6 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                Enregistrer mes choix
            </button>
        </div>
    </div>
</div>

<script>
    // État des cookies
    let cookiePreferences = {
        essential: true,  // Toujours vrai
        analytics: false,
        marketing: false
    };

    // Charger les préférences depuis localStorage
    function loadCookiePreferences() {
        const saved = localStorage.getItem('cookiePreferences');
        if (saved) {
            cookiePreferences = JSON.parse(saved);
            return true;
        }
        return false;
    }

    // Sauvegarder les préférences
    function saveCookiePreferences() {
        localStorage.setItem('cookiePreferences', JSON.stringify(cookiePreferences));
        localStorage.setItem('cookieConsentGiven', 'true');
    }

    // Afficher le banner si nécessaire
    function showCookieConsentIfNeeded() {
        const consentGiven = localStorage.getItem('cookieConsentGiven');
        if (!consentGiven) {
            setTimeout(() => {
                const banner = document.getElementById('cookieConsent');
                banner.classList.remove('hidden');
                banner.classList.add('animate-slide-up');
            }, 1000);
        } else {
            loadCookiePreferences();
            applyCookiePreferences();
        }
    }

    // Toggle détails
    function toggleCookieDetails() {
        const details = document.getElementById('cookieDetails');
        const icon = document.getElementById('detailsToggleIcon');
        const text = document.getElementById('detailsToggleText');
        
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
            text.textContent = 'Voir moins';
        } else {
            details.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
            text.textContent = 'En savoir plus';
        }
    }

    // Accepter tous les cookies
    function acceptAllCookies() {
        cookiePreferences = {
            essential: true,
            analytics: true,
            marketing: true
        };
        saveCookiePreferences();
        applyCookiePreferences();
        hideCookieBanner();
    }

    // Refuser tous les cookies (sauf essentiels)
    function rejectAllCookies() {
        cookiePreferences = {
            essential: true,
            analytics: false,
            marketing: false
        };
        saveCookiePreferences();
        applyCookiePreferences();
        closeCookieSettings();
        hideCookieBanner();
    }

    // Ouvrir les paramètres
    function openCookieSettings() {
        document.getElementById('cookieSettingsModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Charger l'état actuel
        loadCookiePreferences();
        updateToggleStates();
    }

    // Fermer les paramètres
    function closeCookieSettings() {
        document.getElementById('cookieSettingsModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Toggle un cookie spécifique
    function toggleCookie(type) {
        cookiePreferences[type] = !cookiePreferences[type];
        updateToggleStates();
    }

    // Mettre à jour l'affichage des toggles
    function updateToggleStates() {
        const analyticsToggle = document.getElementById('analyticsToggle');
        const marketingToggle = document.getElementById('marketingToggle');
        
        updateToggle(analyticsToggle, cookiePreferences.analytics);
        updateToggle(marketingToggle, cookiePreferences.marketing);
    }

    function updateToggle(toggle, isActive) {
        const circle = toggle.querySelector('div');
        if (isActive) {
            toggle.classList.remove('bg-gray-300');
            toggle.classList.add('bg-green-500');
            circle.style.transform = 'translateX(20px)';
        } else {
            toggle.classList.remove('bg-green-500');
            toggle.classList.add('bg-gray-300');
            circle.style.transform = 'translateX(0)';
        }
    }

    // Sauvegarder les choix personnalisés
    function saveCustomCookies() {
        saveCookiePreferences();
        applyCookiePreferences();
        closeCookieSettings();
        hideCookieBanner();
    }

    // Cacher le banner
    function hideCookieBanner() {
        const banner = document.getElementById('cookieConsent');
        banner.style.transform = 'translateY(200%)';
        setTimeout(() => {
            banner.classList.add('hidden');
        }, 500);
    }

    // Appliquer les préférences (charger les scripts analytics, etc.)
    function applyCookiePreferences() {
        // Google Analytics
        if (cookiePreferences.analytics) {
            // Charger Google Analytics
            // gtag('consent', 'update', { 'analytics_storage': 'granted' });
            console.log('Analytics cookies activés');
        } else {
            console.log('Analytics cookies désactivés');
        }

        // Marketing/Ads
        if (cookiePreferences.marketing) {
            // Charger scripts marketing
            // gtag('consent', 'update', { 'ad_storage': 'granted' });
            console.log('Marketing cookies activés');
        } else {
            console.log('Marketing cookies désactivés');
        }
    }

    // Initialiser au chargement de la page
    document.addEventListener('DOMContentLoaded', showCookieConsentIfNeeded);

    // Fermer modal en cliquant à l'extérieur
    document.getElementById('cookieSettingsModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'cookieSettingsModal') {
            closeCookieSettings();
        }
    });
</script>

<style>
    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(100%);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slide-up 0.5s ease-out forwards;
    }

    .cookie-toggle {
        cursor: pointer;
    }

    .cookie-toggle:hover {
        opacity: 0.9;
    }
</style>