<x-layouts.site title="Accueil">


    <x-site.hero image="/hero2.png" title="{{ __('jd.hero_title') }}"
        subtitle="{{ __('jd.hero_subtitle') }}" />

    <section class="py-24 space-y-12">
        <div class="px-6 text-center space-y-4 mb-12">
            <h2 style="font-family: 'Tangerine', cursive;" class="text-5xl font-bold ">{{ __('jd.hero_cat') }}</h2>
            <p>{{ __('jd.hero_cat_sub') }}</p>
        </div>
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-3 gap-10">

            @forelse ($categories as $collection)
                {{-- <x-site.category-card :title="$collection['name']"/> --}}
                <x-site.category-card :title="$collection['name']" :image="$collection['image']" :url="route('collections.show', $collection)" />

            @empty
                <p class="col-span-3 text-center">
                    {{ __('jd.no_collections') }}
                </p>
            @endforelse
        </div>
    </section>

    <section class="bg-gradient-to-b from-white via-gray-200 to-gray-400 py-24 overflow-hidden dark:bg-gradient-to-b dark:from-gray-900 dark:via-gray-950 dark:to-black">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center animate-on-scroll">
                <div class="inline-block mb-6 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <span
                        class="text-xs uppercase tracking-[0.3em] font-semibold border-b-2 border-gray-300 pb-2">
                        {{ __('jd.our_philosophy') }}
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-8 opacity-0 animate-fade-in-up"
                    style="animation-delay: 0.4s;">
                    <span class="">
                        {{__('jd.a_vision_a_signature')}}
                    </span>
                </h2>
                <div class="flex items-center justify-center gap-4 mb-8 opacity-0 animate-fade-in"
                    style="animation-delay: 0.6s;">
                    <div class="w-12 h-px bg-gradient-to-r from-transparent to-gray-400"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-pulse"></div>
                    <div class="w-12 h-px bg-gradient-to-l from-transparent to-gray-400"></div>
                </div>

                <!-- Paragraphe avec animation -->
                <p class="text-gray-600 leading-relaxed text-lg md:text-xl max-w-3xl mx-auto opacity-0 animate-fade-in-up"
                    style="animation-delay: 0.8s;">
                    {{ __('jd.vision_description') }}
                </p>

                <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">

                    <div class="opacity-0 animate-fade-in-up" style="animation-delay: 1s;">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-gray-900 dark:bg-yellow-900 rounded-full flex items-center justify-center transform hover:scale-110 hover:rotate-12 transition-all duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h3 class="font-semibold  mb-2">{{ __('jd.authenticity') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('jd.authenticity_description') }}</p>
                    </div>

                    <div class="opacity-0 animate-fade-in-up" style="animation-delay: 1.2s;">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-gray-900 dark:bg-yellow-900 rounded-full flex items-center justify-center transform hover:scale-110 hover:rotate-12 transition-all duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold  mb-2">{{ __('jd.matieres_nobles') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('jd.matieres_nobles_description') }}</p>
                    </div>

                    <!-- Valeur 3 -->
                    <div class="opacity-0 animate-fade-in-up" style="animation-delay: 1.4s;">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-gray-900 dark:bg-yellow-900 rounded-full flex items-center justify-center transform hover:scale-110 hover:rotate-12 transition-all duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold  mb-2">{{ __('jd.intemporality') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('jd.intemporality_description') }}</p>
                    </div>
                </div>

                <!-- Bouton CTA (optionnel) -->
                <div class="mt-12 opacity-0 animate-fade-in-up " style="animation-delay: 1.6s;">
                    <a href="/about"
                        class="dark:bg-yellow-900 dark:text-white inline-block px-8 py-3 border-2 border-gray-900 text-gray-900 font-semibold uppercase tracking-wider text-sm hover:bg-gray-900 hover:text-white transition-all duration-300 transform hover:scale-105">
                        {{ __('jd.our_history') }}
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="mt-24">
        <div class="px-6 text-center space-y-4">
            <h2 style="font-family: 'Tangerine', cursive;" class="text-5xl font-bold">{{ __('jd.prod_title') }}</h2>
            <p>{{ __('jd.prod_subtitle') }}</p>
        </div>
        <div class="max-w-7xl mx-auto px-6 py-24 grid grid-cols-4 gap-8">
            @forelse ($produits as $product)
                <x-site.product-card :product="$product" />
            @empty
                <p class="col-span-4 text-center text-gray-500">
                    {{ __('jd.prod_empty') }}
                </p>
            @endforelse
        </div>
    </section>


    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation de fade in simple */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Classe d'animation */
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        /* Animation au scroll (version simple sans JS) */
        @media (prefers-reduced-motion: no-preference) {
            .animate-on-scroll {
                animation: fadeInUp 1s ease-out;
            }
        }

        /* Responsive - réduire les délais sur mobile */
        @media (max-width: 768px) {

            .animate-fade-in-up,
            .animate-fade-in {
                animation-duration: 0.6s !important;
            }

            [style*="animation-delay"] {
                animation-delay: 0.1s !important;
            }
        }
    </style>
</x-layouts.site>
