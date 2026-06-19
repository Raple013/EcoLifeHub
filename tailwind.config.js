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
                serif: ['"Playfair Display"', 'Georgia', 'Times New Roman', 'serif'],
                sans: ['"DM Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                forest: {
                    50: '#f0f4f1',
                    100: '#d9e4db',
                    200: '#b3c9b4',
                    300: '#87a88a',
                    400: '#5d8762',
                    500: '#3d6b42',
                    600: '#1a3c2a',
                    700: '#153022',
                    800: '#10241b',
                    900: '#0a1812',
                },
                sage: {
                    50: '#f4f6f3',
                    100: '#e2e9e0',
                    200: '#bfcfba',
                    300: '#96af8f',
                    400: '#6d8a64',
                    500: '#546e4c',
                    600: '#41563b',
                    700: '#32422d',
                    800: '#232e20',
                },
                gold: {
                    50: '#fcf8ef',
                    100: '#f6edcf',
                    200: '#ebd995',
                    300: '#dcbf5c',
                    400: '#c4a35a',
                    500: '#a8883a',
                    600: '#8a6e2e',
                    700: '#6c5624',
                },
                clay: {
                    50: '#f9f4f0',
                    100: '#efe1d4',
                    200: '#dfc1a8',
                    300: '#ce9d7c',
                    400: '#b88264',
                    500: '#9e6850',
                },
                cream: {
                    DEFAULT: '#f5f2ec',
                    50: '#faf8f4',
                    100: '#f5f2ec',
                    200: '#ebe4d6',
                    300: '#dbcfb8',
                    400: '#c9b595',
                },
                ink: '#1c1c1c',
                muted: '#7a8a7a',
            },
            boxShadow: {
                'card': '0 1px 3px rgba(26, 60, 42, 0.06), 0 1px 2px rgba(26, 60, 42, 0.04)',
                'card-hover': '0 4px 16px rgba(26, 60, 42, 0.10)',
                'warm': '0 2px 12px rgba(26, 60, 42, 0.06)',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out forwards',
                'fade-up': 'fadeUp 0.6s ease-out forwards',
                'slide-down': 'slideDown 0.2s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideDown: {
                    '0%': { opacity: '0', transform: 'translateY(-6px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },

    plugins: [forms],
};
