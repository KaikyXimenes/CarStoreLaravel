<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts (do Laravel/Breeze - Isto carrega o Tailwind) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        {{-- O 'dark:bg-gray-900' é Tailwind --}}
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
            {{-- A barra de navegação (já usa Tailwind) --}}
            @include('layouts.navigation')

            <!-- Page Heading (Cabeçalho, se existir) -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content (Conteúdo Principal) -->
            <main>
                {{-- O nosso conteúdo (das páginas 'content') entra aqui --}}
                @yield('content')
            </main>
        </div>
        
        {{-- Sítio para injetar JS (como o das 'fotos extras') --}}
        @stack('scripts')
    </body>
</html>