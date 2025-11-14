<x-guest-layout>
    {{-- MUDANÇA: Aumentei a largura de 'max-w-md' para 'max-w-xl' --}}
    <div class="w-full sm:max-w-xl mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        
        {{-- MUDANÇA: Adicionei um título (como no iCarros) --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-200 mb-6">
            Crie a sua Conta
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nome -->
            <div>
                {{-- MUDANÇA: 'Name' para 'Nome' --}}
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Senha -->
            <div class="mt-4">
                {{-- MUDANÇA: 'Password' para 'Senha' --}}
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmar Senha -->
            <div class="mt-4">
                {{-- MUDANÇA: 'Confirm Password' para 'Confirmar Senha' --}}
                <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                {{-- MUDANÇA: 'Already registered?' para 'Já tem conta?' --}}
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Já tem conta?') }}
                </a>

                {{-- MUDANÇA: 'Register' para 'Registar' --}}
                <x-primary-button class="ms-4 !text-base !py-3"> {{-- MUDANÇA: Botão maior --}}
                    {{ __('Registar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>