<nav class="w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 backdrop-blur-sm transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div id="promo-bar" class="border-b border-gray-100 dark:border-gray-800 py-2 text-center overflow-hidden transition-all duration-300 ease-in-out max-h-20 opacity-100 translate-y-0">
            <p class="text-xs text-gray-600 dark:text-gray-400">
                ✨ {{ __('jd.promobar') }}
            </p>
        </div>

        <div class="flex items-center justify-between py-4">
            <a href="{{ route('home') }}" style="font-family: 'Tangerine', cursive;"
                class="text-sm md:text-3xl font-extrabold tracking-wider text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                Mh Beauty & Creation
            </a>

            <div class="hidden md:flex items-center space-x-8">
                @php
                    $navLinks = [
                        'home' => 'jd.home',
                        'collections.index' => 'jd.collections',
                        'accessoires.index' => 'jd.accessories',
                        'about' => 'jd.about',
                    ];
                @endphp
                @foreach($navLinks as $route => $label)
                <a href="{{ route($route) }}"
                    class="text-sm font-medium transition-colors relative group {{ Route::is($route) ? 'text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300' }}">
                    {{ __($label) }}
                    <span class="absolute bottom-0 left-0 {{ Route::is($route) ? 'w-full' : 'w-0' }} h-0.5 bg-gray-900 dark:bg-white group-hover:w-full transition-all duration-300"></span>
                </a>
                @endforeach
            </div>

            <div class="flex items-center space-x-2">
                <x-site.language-switcher />

                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors theme-toggle">
                    <svg class="theme-toggle-light-icon w-5 h-5 text-yellow-500 hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/></svg>
                    <svg class="theme-toggle-dark-icon w-5 h-5 text-gray-400 hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                </button>

                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors" id="search-button">
                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>

                <a href="{{ route('wishlist') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors relative">
                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center hidden">0</span>
                </a>

                <button class="md:hidden p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors" id="mobile-menu-button">
                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>
    </div>

    <div class="hidden md:hidden border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900" id="mobile-menu">
        <div class="px-6 py-4 space-y-3">
            @foreach($navLinks as $route => $label)
                <a href="{{ route($route) }}" class="block py-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __($label) }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

<div id="spotlight-search" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 opacity-0 transition-opacity duration-200">
    <div class="w-full max-w-2xl transform scale-95 transition-transform duration-200" id="spotlight-container">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="{{ __('Rechercher...') }}" id="spotlight-input" class="flex-1 text-lg text-gray-900 dark:text-white bg-transparent focus:outline-none" autocomplete="off" />
                <kbd class="hidden md:block px-2 py-1 text-xs font-semibold text-gray-500 bg-gray-100 dark:bg-gray-700 rounded">ESC</kbd>
            </div>
            <div id="spotlight-results" class="max-h-96 overflow-y-auto p-3">
                <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('Suggestions') }}</div>
                <a href="{{ route('collections.show', 'bijoux') }}" class="flex items-center px-3 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg group">
                    <span class="text-2xl mr-3">💍</span>
                    <span class="text-gray-700 dark:text-gray-300">{{ __('Bijoux') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // --- GESTION PROMO BAR (SCROLL) ---
    const promoBar = document.getElementById('promo-bar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            promoBar.classList.replace('max-h-20', 'max-h-0');
            promoBar.classList.replace('opacity-100', 'opacity-0');
            promoBar.classList.add('-translate-y-2');
        } else {
            promoBar.classList.replace('max-h-0', 'max-h-20');
            promoBar.classList.replace('opacity-0', 'opacity-100');
            promoBar.classList.remove('-translate-y-2');
        }
    });

    // --- SPOTLIGHT SEARCH ---
    const searchBtn = document.getElementById('search-button');
    const searchModal = document.getElementById('spotlight-search');
    const searchContainer = document.getElementById('spotlight-container');
    const searchInput = document.getElementById('spotlight-input');

    const openSearch = () => {
        searchModal.classList.remove('hidden');
        searchModal.classList.add('flex');
        setTimeout(() => { searchModal.classList.add('opacity-100'); searchContainer.classList.replace('scale-95', 'scale-100'); searchInput.focus(); }, 10);
    };

    const closeSearch = () => {
        searchModal.classList.remove('opacity-100');
        searchContainer.classList.replace('scale-100', 'scale-95');
        setTimeout(() => { searchModal.classList.add('hidden'); searchModal.classList.remove('flex'); }, 200);
    };

    searchBtn.addEventListener('click', openSearch);
    searchModal.addEventListener('click', (e) => { if(e.target === searchModal) closeSearch(); });
    document.addEventListener('keydown', (e) => { if(e.key === 'Escape') closeSearch(); });

    // --- THÈME ET PANIER (Comme précédemment) ---
    const updateIcons = (isDark) => {
        document.querySelectorAll('.theme-toggle-light-icon').forEach(el => el.classList.toggle('hidden', !isDark));
        document.querySelectorAll('.theme-toggle-dark-icon').forEach(el => el.classList.toggle('hidden', isDark));
    };
    const isDark = localStorage.getItem('theme') === 'dark' || document.documentElement.classList.contains('dark');
    updateIcons(isDark);

    document.querySelectorAll('.theme-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const dark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', dark ? 'dark' : 'light');
            updateIcons(dark);
        });
    });

    function updateCart() {
        const count = (JSON.parse(localStorage.getItem('wishlist')) || []).length;
        const badge = document.getElementById('cart-count');
        if(badge) { badge.textContent = count; badge.classList.toggle('hidden', count === 0); }
    }
    updateCart();
    window.addEventListener('storage', updateCart);
    document.getElementById('mobile-menu-button').addEventListener('click', () => document.getElementById('mobile-menu').classList.toggle('hidden'));
</script>