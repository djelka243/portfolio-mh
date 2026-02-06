<x-layouts.site title="À propos">
    <!-- Breadcrumb -->
    <div class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="/" class="text-gray-500 hover:text-gray-900">{{ __('jd.home') }}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="font-medium">{{ __('jd.about') }}</span>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-gray-900 to-gray-800 text-white py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <div class="inline-block mb-6 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <span class="text-xs uppercase tracking-[0.3em] text-gray-300 font-semibold border-b border-gray-500 pb-2">
                    {{ __('jd.our_history') }}
                </span>
            </div>
            
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.4s;">
                Mh Beauty & Creation
            </h1>
            
            <div class="flex items-center justify-center gap-4 mb-8 opacity-0 animate-fade-in" style="animation-delay: 0.6s;">
                <div class="w-16 h-px bg-gradient-to-r from-transparent to-white"></div>
                <div class="w-2 h-2 bg-white rounded-full"></div>
                <div class="w-16 h-px bg-gradient-to-l from-transparent to-white"></div>
            </div>
            
            <p class="text-xl md:text-2xl leading-relaxed text-gray-200 max-w-3xl mx-auto opacity-0 animate-fade-in-up" style="animation-delay: 0.8s;">
                {{ __('jd.hero_subtitle') }}
            </p>
        </div>
    </section>

    
    <section class="py-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      
                <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="relative">
           
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ asset('prop.png') }}" 
                                 alt="Photo du Propriétaire"
                                 class="w-full h-[600px] object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        
          
                        <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-gray-900 dark:bg-yellow-900 rounded-2xl -z-10"></div>
                        <div class="absolute -top-6 -left-6 w-32 h-32 border-4 border-gray-900 rounded-2xl"></div>
                        
                        <!-- Badge -->
                        <div class="absolute bottom-8 left-8 bg-white rounded-xl shadow-xl p-4">
                            <p class="text-sm text-gray-600 mb-1">{{ __('jd.founder') }}</p>
                            <p class="text-xl font-bold text-gray-900">Mariame Anifa</p>
                        </div>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <h2 class="text-4xl font-bold mb-6">
                        {{ __('jd.meet_founder') }}
                    </h2>
                    
                    <div class="w-20 h-1 bg-gray-900 dark:bg-gray-500 mb-8"></div>
                    
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p class="text-lg">
                            {{ __('jd.meet_our_team') }}
                        
                        <p>
                            {{__('jd.meet_our_team_2') }}
                        </p>
                    </div>

                    <!-- Stats ou réalisations -->
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2">2020</p>
                            <p class="text-sm text-gray-600">{{ __('jd.year_founded') }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2">25+</p>
                            <p class="text-sm text-gray-600">{{ __('jd.collections_created') }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2">500+</p>
                            <p class="text-sm text-gray-600">{{ __('jd.happy_clients') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50 dark:bg-zinc-900">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">{{ __('jd.our_values') }}</h2>
                <div class="w-20 h-1 bg-gray-900 dark:bg-gray-400 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Valeur 1 -->
                <div class="text-center group opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-900 dark:bg-yellow-900 rounded-full flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ __('jd.authenticity') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('jd.authenticity_description') }}
                    </p>
                </div>
                
                <!-- Valeur 2 -->
                <div class="text-center group opacity-0 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-900 dark:bg-yellow-900 rounded-full flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ __('jd.craftsmanship') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('jd.craftsmanship_description') }}
                    </p>
                </div>
                
                <!-- Valeur 3 -->
                <div class="text-center group opacity-0 animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-900 dark:bg-yellow-900 rounded-full flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ __('jd.innovation') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('jd.innovation_description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="max-md:mt-24 md:py-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">{{ __('jd.our_workshop') }}</h2>
                <div class="w-20 h-1 bg-gray-900 dark:bg-gray-400 mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">{{ __('jd.workshop_description') }}</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @for($i = 1; $i <= 4; $i++)
                <div class="relative overflow-hidden rounded-lg group aspect-square opacity-0 animate-fade-in-up" style="animation-delay: {{ $i * 0.1 }}s;">
                    <img src="{{ asset('storage/atelier/' . $i . '.jpg') }}" 
                         alt="Atelier {{ $i }}"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors"></div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="py-24 bg-gradient-to-b from-gray-50 to-white dark:bg-gradient-to-t dark:from-gray-900 dark:to-gray-900">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact -->
                <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <h2 class="text-3xl font-bold  mb-8">{{ __('jd.contact_us') }}</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold  mb-1">{{ __('jd.address') }}</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $infos['adresse'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold  mb-1">{{ __('jd.phone') }}</h3>
                                <a href="tel:{{ $infos['telephone'] }}" class="text-gray-600 hover: transition-colors">
                                    {{ $infos['telephone'] }}
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold  mb-1">{{ __('jd.email') }}</h3>
                                <a href="mailto:{{ $infos['email'] }}" class="text-gray-600 hover: transition-colors">
                                    {{ $infos['email'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <h2 class="text-3xl font-bold  mb-8">{{ __('jd.legal_information') }}</h2>
                    
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg p-8 border border-gray-100">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="font-semibold text-gray-700 dark:text-gray-400">RCCM</span>
                                <span class="text-gray-900 dark:text-gray-400 font-mono">{{ $infos['rccm'] }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="font-semibold text-gray-700 dark:text-gray-400">NIF</span>
                                <span class="text-gray-900 dark:text-gray-400 font-mono">{{ $infos['nif'] }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-3">
                                <span class="font-semibold text-gray-700 dark:text-gray-400">Statut</span>
                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                    {{ __('jd.active_company') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-zinc-900 text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <svg class="w-12 h-12 mx-auto mb-6 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p class="text-2xl md:text-3xl font-light italic leading-relaxed text-gray-300 mb-6">
                    « {{ __('jd.elegance_quote') }} »
                </p>
                <p class="text-gray-500 text-sm uppercase tracking-wider">
                    {{ __('jd.our_motto') }}
                </p>
            </div>
        </div>
    </section>
</x-layouts.site>

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
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
    }
    
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }
</style>