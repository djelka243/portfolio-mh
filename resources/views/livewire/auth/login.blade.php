<x-layouts.auth>
    <div class="fixed inset-0 flex h-screen w-full bg-gradient-to-br from-zinc-200 via-gray-100 to-indigo-500/30 dark:from-zinc-950 dark:via-zinc-900 dark:to-indigo-950/20">
        
        <!-- Left Panel - Login Form -->
        <div class="flex w-full flex-col justify-between px-8 md:w-1/2 lg:w-[40%] xl:w-[35%] sm:px-12 lg:px-16 overflow-y-auto relative">
            
            <!-- Logo -->
            <div class="flex justify-center animate-fade-in">
                <img src="/1.png" alt="Mh Beauty" class="h-56 w-auton" />
            </div>

            <!-- Main Content -->
            <div class="mx-auto w-full max-w-md">
                <div class="mb-10 animate-slide-up">
                    <h1 class="text-2xl font-bold tracking-tight dark:text-white bg-gradient-to-r from-zinc-900 via-indigo-900 to-zinc-900 dark:from-white dark:via-indigo-200 dark:to-white bg-clip-text text-transparent">
                        {{ __('Content de vous revoir') }}
                    </h1>
                    <p class="mt-4 text-base text-zinc-600 dark:text-zinc-400">
                        {{ __('Connectez-vous pour accéder à votre tableau de bord') }}
                    </p>
                </div>

                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login.store') }}" class="grid gap-6 animate-slide-up animation-delay-200">
                    @csrf

                    <!-- Email Input -->
                    <div class="group">
                        <flux:input
                            name="email"
                            :label="__('Adresse e-mail')"
                            :value="old('email')"
                            type="email"
                            required
                            autofocus
                            placeholder="nom@exemple.com"
                            class="!bg-white dark:!bg-zinc-800/50 !border-zinc-200 dark:!border-zinc-700 focus:!border-indigo-500 focus:!ring-indigo-500/20 transition-all duration-200"
                        />
                    </div>

                    <!-- Password Input -->
                    <div class="grid gap-2">
                        <div class="flex items-center justify-between">
                            <flux:label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Mot de passe') }}</flux:label>
                            @if (Route::has('password.request'))
                                <flux:link class="text-xs font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors" :href="route('password.request')" wire:navigate>
                                    {{ __('Mot de passe oublié ?') }}
                                </flux:link>
                            @endif
                        </div>
                        <flux:input
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••••"
                            viewable
                            class="!bg-white dark:!bg-zinc-800/50 !border-zinc-200 dark:!border-zinc-700 focus:!border-indigo-500 focus:!ring-indigo-500/20 transition-all duration-200"
                        />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between py-1">
                        <flux:checkbox 
                            name="remember" 
                            :label="__('Rester connecté')" 
                            :checked="old('remember')"
                            class="text-indigo-600 focus:ring-indigo-500"
                        />
                    </div>

                    <!-- Submit Button -->
                    <flux:button 
                        variant="primary" 
                        type="submit" 
                        class="w-full !bg-gradient-to-r bg-gray-900 hover:to-indigo-800 !shadow-lg !shadow-indigo-500/30 dark:!shadow-indigo-500/20 transform hover:scale-[1.02] transition-all duration-200 !py-3 !font-semibold" 
                        data-test="login-button"
                    >
                        {{ __('Se connecter') }}
                    </flux:button>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-xs text-zinc-500 dark:text-zinc-500 flex items-center justify-between animate-fade-in animation-delay-600">
                <span>&copy; {{ date('Y') }} Mh Beauty & Creation Inc.</span>
                <span class="hidden sm:inline">{{ __('Tous droits réservés.') }}</span>
            </div>
        </div>

        <!-- Right Panel - Hero Section -->
        <div class="hidden md:block md:w-1/2 lg:w-[60%] xl:w-[65%] relative overflow-hidden">
            <!-- Background Image -->
            <img 
                src="hero.png" 
                alt="Background" 
                class="absolute inset-0 object-cover w-full h-full scale-110 animate-slow-zoom"
            />
            
            <!-- Overlays -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 via-purple-600/10 to-pink-600/20 backdrop-blur-[1px]"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-zinc-900/95 via-zinc-900/60 to-transparent"></div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-20 right-20 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-40 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse-slow animation-delay-1000"></div>
            
            <!-- Content -->
            <div class="absolute inset-0 flex flex-col justify-between p-12 lg:p-20">
                <!-- Top Badge -->
                <div class="animate-slide-down">
                    <div class="inline-flex ">
                        
                    </div>
                </div>
                <div class="max-w-2xl animate-slide-up animation-delay-400">
                    <h2 class="text-5xl lg:text-6xl font-bold leading-tight text-white mb-6">
                        Simplifiez la gestion de votre site.
                    </h2>
                    <p class="text-lg text-zinc-300 mb-8 max-w-lg leading-relaxed">
                        Une plateforme moderne et intuitive pour gérer votre activité en toute simplicité. Performant, sécurisé et conçu pour votre succès.
                    </p>
                    
                    <!-- Features -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                        <div class="flex items-center gap-3 text-white/90">
                            <div class="flex-shrink-0 w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center backdrop-blur-sm border border-white/10">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">Ultra-rapide</div>
                                <div class="text-xs text-zinc-400">Performance optimale</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-white/90">
                            <div class="flex-shrink-0 w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center backdrop-blur-sm border border-white/10">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">100% Sécurisé</div>
                                <div class="text-xs text-zinc-400">Données protégées</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-white/90">
                            <div class="flex-shrink-0 w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center backdrop-blur-sm border border-white/10">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">Simple</div>
                                <div class="text-xs text-zinc-400">Interface intuitive</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slow-zoom {
            0%, 100% {
                transform: scale(1.1);
            }
            50% {
                transform: scale(1.15);
            }
        }

        @keyframes pulse-slow {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.5;
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }

        .animate-slide-down {
            animation: slide-down 0.6s ease-out;
        }

        .animate-slow-zoom {
            animation: slow-zoom 20s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-400 {
            animation-delay: 0.4s;
        }

        .animation-delay-600 {
            animation-delay: 0.6s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }
    </style>
</x-layouts.auth>