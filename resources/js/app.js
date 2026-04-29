import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const themeToggle = document.querySelector('[data-theme-toggle]');
const moonIcon = document.querySelector('[data-theme-icon="moon"]');
const sunIcon = document.querySelector('[data-theme-icon="sun"]');

function syncThemeIcon() {
    if (!moonIcon || !sunIcon || !themeToggle) {
        return;
    }

    const isDark = document.documentElement.classList.contains('dark');

    moonIcon.classList.toggle('hidden', isDark);
    sunIcon.classList.toggle('hidden', !isDark);
    themeToggle.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
}

themeToggle?.addEventListener('click', () => {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    syncThemeIcon();
});

syncThemeIcon();
