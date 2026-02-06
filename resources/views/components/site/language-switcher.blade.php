<div class="relative hidden md:block" id="language-selector-desktop">
    <button type="button" 
        class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors text-2xl"
        id="language-button-desktop" 
        aria-label="Changer de langue">
        <span id="current-flag-desktop">
            {{ config('app.locales')[app()->getLocale()]['flag'] ?? '🌐' }}
        </span>
    </button>

    <div id="language-menu-desktop"
        class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden z-50">
        
        <div class="px-4 py-2 text-[10px] font-bold uppercase text-gray-400 border-b border-gray-100 dark:border-gray-700">
            {{ __('jd.choose_language') }}
        </div>

        @foreach(config('app.locales') as $code => $locale)
            <button
                class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors {{ app()->getLocale() === $code ? 'bg-blue-50/50 dark:bg-blue-900/20' : '' }}"
                onclick="window.location.href='{{ route('language.switch', $code) }}'">
                <span class="text-xl">{{ $locale['flag'] }}</span>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $locale['name'] }}</span>
                
                @if(app()->getLocale() === $code)
                    <svg class="w-4 h-4 text-blue-500 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                @endif
            </button>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('language-button-desktop');
    const menu = document.getElementById('language-menu-desktop');

    // Toggle menu
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });

    // Fermer si on clique ailleurs
    document.addEventListener('click', function(e) {
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    // Optionnel : Fermer avec la touche Echap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') menu.classList.add('hidden');
    });
});
</script>