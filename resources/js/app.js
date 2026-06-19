import './bootstrap';
import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
});

// AUTO SEARCH GLOBAL (AMAN UNTUK SEMUA PAGE)
document.addEventListener('DOMContentLoaded', () => {

    const inputs = document.querySelectorAll('[data-auto-search="true"]');

    inputs.forEach((input) => {

        const form = input.closest('form');

        if (!form) return;

        let timeout = null;

        input.addEventListener('input', () => {

            clearTimeout(timeout);

            timeout = setTimeout(() => {

                form.requestSubmit();

            }, 500);

        });

    });

});