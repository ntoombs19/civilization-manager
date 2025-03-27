import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
            animation: {
                'ping': 'ping 2s ease-in-out infinite',
                'twinkle': 'twinkle 8s infinite',
            },
            keyframes: {
                ping: {
                    '0%': { transform: 'scale(1)', opacity: '0.8' },
                    '70%, 100%': { transform: 'scale(1.5)', opacity: '0' },
                },
                twinkle: {
                    '0%': { opacity: '0' },
                    '50%': { opacity: '1' },
                    '100%': { opacity: '0' },
                },
            },
            shadow: {
                'text': '0 0 8px rgba(255, 215, 0, 0.5)',
            }
        },
    },

    plugins: [forms],
};
