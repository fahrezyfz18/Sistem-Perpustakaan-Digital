import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            //Tambahan Design Sistem
            colors: {
                primary: '#364E31',
                secondary: '#756633',
                accent: '#4a6345',
                background: '#F5F5F5',

                //Opsional (tambahan)
                olivine: '#9AB283',
                asparagus: '#8FA96D',
                camel: '#BC9E5F',
            }
        },
    },

    plugins: [forms],
};