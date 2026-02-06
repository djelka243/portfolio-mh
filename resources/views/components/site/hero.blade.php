<section class="relative h-[90vh] flex items-center justify-center bg-cover bg-center overflow-hidden hero-section"
    style="background-image: url('{{ $image }}')">
    
    <!-- Overlay avec animation de fondu -->
    <div class="bg-black/50 absolute inset-0 hero-overlay"></div>
    
    <!-- Contenu principal -->
    <div class="relative text-center px-6 max-w-4xl mx-auto hero-content">
        
        <!-- Titre avec animation -->
        <h1 class="text-5xl md:text-3xl lg:text-5xl font-extrabold uppercase tracking-wider mb-6 hero-title text-white"
            style="font-family: 'Vast Shadow', cursive; text-shadow: 2px 4px 8px rgba(0,0,0,0.6);">
            {{ $title }}
        </h1>
        
        <!-- Ligne décorative animée -->
        <div class="w-24 h-1 bg-white mx-auto mb-6 hero-line"></div>
        
        <!-- Sous-titre avec animation -->
        <p class="text-md font-extralight tracking-wide leading-relaxed hero-subtitle text-white "
            style="text-shadow: 1px 2px 4px rgba(0,0,0,0.6);">
            {{ $subtitle }}
        </p>
        
        <!-- Bouton CTA animé -->
        <div class="mt-10 hero-cta">
            <a href="{{ route('collections.index') }}" 
                class="inline-block px-8 py-4 bg-white dark:bg-gray-900 dark:hover:bg-yellow-900 font-semibold uppercase tracking-wider text-sm hover:bg-gray-900  hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg">
                {{ __('jd.hero_btn') }}
            </a>
        </div>
    </div>
    
    <!-- Indicateur de scroll animé -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hero-scroll">
        <svg class="w-6 h-6 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
    
    <!-- Particules décoratives flottantes -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
        <div class="particle particle-5"></div>
    </div>
</section>

<!-- Animations CSS -->
<style>
    /* Animation de l'overlay */
    .hero-overlay {
        animation: fadeIn 1s ease-out;
    }
    
    /* Animation du contenu principal */
    .hero-content {
        animation: slideUp 1s ease-out 0.3s both;
    }
    
    /* Animation du titre */
    .hero-title {
        animation: slideUp 1s ease-out 0.5s both;
    }
    
    /* Animation de la ligne */
    .hero-line {
        animation: expandWidth 0.8s ease-out 0.9s both;
    }
    
    /* Animation du sous-titre */
    .hero-subtitle {
        animation: slideUp 1s ease-out 1.2s both;
    }
    
    /* Animation du bouton CTA */
    .hero-cta {
        animation: slideUp 1s ease-out 1.5s both;
    }
    
    /* Animation de l'indicateur de scroll */
    .hero-scroll {
        animation: fadeIn 1s ease-out 1.8s both;
    }
    
    /* Keyframes */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes expandWidth {
        from {
            opacity: 0;
            transform: scaleX(0);
        }
        to {
            opacity: 1;
            transform: scaleX(1);
        }
    }
    
    /* Particules flottantes */
    .particle {
        position: absolute;
        width: 8px;
        height: 8px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .particle-1 {
        left: 10%;
        top: 20%;
        animation-delay: 0s;
        animation-duration: 7s;
    }
    
    .particle-2 {
        left: 80%;
        top: 30%;
        animation-delay: 1s;
        animation-duration: 6s;
    }
    
    .particle-3 {
        left: 30%;
        top: 70%;
        animation-delay: 2s;
        animation-duration: 8s;
    }
    
    .particle-4 {
        left: 70%;
        top: 60%;
        animation-delay: 1.5s;
        animation-duration: 7.5s;
    }
    
    .particle-5 {
        left: 50%;
        top: 40%;
        animation-delay: 0.5s;
        animation-duration: 6.5s;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 0.3;
        }
        50% {
            transform: translateY(-80px) translateX(40px);
            opacity: 0.6;
        }
        90% {
            opacity: 0.3;
        }
    }
    
    /* Effet de zoom sur l'image au chargement */
    .hero-section {
        animation: zoomIn 1.5s ease-out;
    }
    
    @keyframes zoomIn {
        from {
            transform: scale(1.1);
        }
        to {
            transform: scale(1);
        }
    }
</style>