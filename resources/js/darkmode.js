// Fonction pour initialiser le thème
function initTheme() {
    // Vérifier si un thème est déjà sauvegardé
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    // Déterminer le thème à utiliser
    const theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
    
    // Appliquer le thème
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    
    // Mettre à jour les icônes
    updateThemeIcons(theme);
}

// Fonction pour basculer le thème
function toggleTheme() {
    const isDark = document.documentElement.classList.contains('dark');
    
    if (isDark) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        updateThemeIcons('light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        updateThemeIcons('dark');
    }
}

// Fonction pour mettre à jour les icônes
function updateThemeIcons(theme) {
    const lightIcons = document.querySelectorAll('.theme-toggle-light-icon');
    const darkIcons = document.querySelectorAll('.theme-toggle-dark-icon');
    
    if (theme === 'dark') {
        lightIcons.forEach(icon => icon.classList.remove('hidden'));
        darkIcons.forEach(icon => icon.classList.add('hidden'));
    } else {
        lightIcons.forEach(icon => icon.classList.add('hidden'));
        darkIcons.forEach(icon => icon.classList.remove('hidden'));
    }
}

// Initialiser le thème dès que possible
initTheme();

// Exposer les fonctions globalement
window.toggleTheme = toggleTheme;
window.initTheme = initTheme;

// Réinitialiser après le chargement complet
document.addEventListener('DOMContentLoaded', initTheme);

// Écouter les changements de préférence système
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
        // Si l'utilisateur n'a pas de préférence sauvegardée, suivre le système
        if (e.matches) {
            document.documentElement.classList.add('dark');
            updateThemeIcons('dark');
        } else {
            document.documentElement.classList.remove('dark');
            updateThemeIcons('light');
        }
    }
});