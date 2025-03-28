import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms'
import textshadow from 'tailwindcss-textshadow'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Trajan Pro', ...defaultTheme.fontFamily.serif],
            },
            textShadow: {
                'glow': '0 0 8px rgba(255, 215, 0, 0.5)'
            }
        },
    },

    plugins: [forms, textshadow],
};
