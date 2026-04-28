import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#364E31',   // Kombu
                secondary: '#756633', // Mustard
                accent: '#4a6345',
                background: '#F5F5F5',
                kombu: '#364E31',
                mustard: '#756633',
                olivine: '#9AB283',
                asparagus: '#8FA96D',
                camel: '#BC9E5F',
            }
        },
    },

    safelist: [
        'bg-olivine',
        'bg-asparagus',
        'bg-kombu',
        'bg-mustard',
        'text-olivine',
        'text-asparagus',
        'text-kombu',
        'text-mustard',
    ],

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};