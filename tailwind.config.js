// 1. Importa o plugin de formulários
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // Isto lê os ficheiros do Breeze (login, etc.)
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        
        // ESTA É A LINHA MAIS IMPORTANTE
        // Isto diz ao Tailwind para ler TODOS os nossos ficheiros .blade.php
        // (Públicos, Admin, Layouts, Partials, TUDO)
        './resources/views/**/*.blade.php', 
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    // 2. ESTA É A CORREÇÃO FINAL
    // Estamos a dizer ao Tailwind para USAR o plugin de formulários
    plugins: [forms],
};