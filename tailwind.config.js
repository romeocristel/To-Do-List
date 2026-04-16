import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                display: ['Playfair Display', 'serif'],
            },

            colors: {
                primary: '#1D9E75',
                primaryDark: '#0F6E56',
                danger: '#A32D2D',
                border: '#e5e5e5',
                muted: '#888',
                light: '#f5f4f0',
            },

            boxShadow: {
                soft: '0 2px 6px rgba(0,0,0,0.05)',
            },
        },
    },

    plugins: [forms],
};