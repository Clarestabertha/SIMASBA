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
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#2D2A6C',
                secondary: '#EC6A28',
                ketiga: '#CFDFEE',
                keempat : '#FFF0E2',
                abu : '#C1C1C1',
            },
            width:{
                '128':'32rem',
                '100':'29rem',
            },
            height:{
                '80':'20rem',
                '72':'18rem',
            },
            fontSize: {
                '5xl': '3rem', 
            },
        },
    },

    plugins: [forms],
};
