@extends('layouts.app')

{{-- Define o cabeçalho que o 'app.blade.php' espera --}}
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard Administrativo') }}
    </h2>
@endsection

{{-- Define o conteúdo principal --}}
@section('content')
    {{-- 'py-12' = padding (espaçamento) vertical --}}
    <div class="py-12">
        {{-- 'max-w-7xl mx-auto...' = o 'container' padrão do Breeze/Tailwind --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- O "Jumbotron" de Boas-Vindas --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-center text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold">Bem-vindo, Admin!</h1>
                    <p class="text-lg mt-2">
                        Use os links abaixo para gerir o conteúdo do site.
                    </p>
                </div>
            </div>

            {{-- 'Alert' de Sucesso (já em Tailwind) --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- A Grelha (Grid) para os 4 Cartões --}}
            {{-- 'grid-cols-1' = 1 coluna em telemóvel --}}
            {{-- 'md:grid-cols-4' = 4 colunas em ecrãs médios (desktop) --}}
            {{-- 'gap-6' = espaçamento entre os cartões --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                {{-- Cartão 1: Marcas --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h5 class="text-xl font-semibold">Marcas</h5>
                        <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">Gerir as marcas de veículos (ex: Fiat, Ford, VW).</p>
                        
                        {{-- Este é o botão padrão do Breeze/Tailwind --}}
                        <a href="{{ route('admin.brands.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mt-4">
                            Gerir Marcas
                        </a>
                    </div>
                </div>

                {{-- Cartão 2: Modelos --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h5 class="text-xl font-semibold">Modelos</h5>
                        <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">Gerir os modelos (ex: Uno, Ka, Gol).</p>
                        <a href="{{ route('admin.models.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mt-4">
                            Gerir Modelos
                        </a>
                    </div>
                </div>

                {{-- Cartão 3: Cores --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h5 class="text-xl font-semibold">Cores</h5>
                        <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">Gerir as cores (ex: Preto, Prata).</p>
                        <a href="{{ route('admin.colors.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mt-4">
                            Gerir Cores
                        </a>
                    </div>
                </div>

                {{-- Cartão 4: Veículos --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h5 class="text-xl font-semibold">Veículos</h5>
                        <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">Gerir o cadastro completo dos veículos.</p>
                        <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mt-4">
                            Gerir Veículos
                        </a>
                    </div>
                </div>

            </div> {{-- Fim da Grelha (Grid) --}}

        </div>
    </div>
@endsection