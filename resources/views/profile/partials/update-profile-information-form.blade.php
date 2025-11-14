<section>
    <header>
        {{-- MUDANÇA: Título muito maior e mais "pesado" --}}
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Informações do Perfil') }}
        </h2>

        {{-- MUDANÇA: Descrição maior e com mais espaçamento --}}
        <p class="mt-2 mb-6 text-lg text-gray-600 dark:text-gray-400">
            {{ __("Atualize as informações de perfil e endereço de e-mail da sua conta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            {{-- MUDANÇA: Rótulo (Label) maior --}}
            <x-input-label for="name" :value="__('Nome')" class="!text-lg" />
            {{-- MUDANÇA: Texto da caixa de input maior --}}
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full !text-lg" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="!text-lg" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full !text-lg" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            {{-- ESTA É A PARTE QUE ESTAVA "PARTIDA" --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('O seu endereço de e-mail não foi verificado.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Um novo link de verificação foi enviado para o seu e-mail.') }}
                        </p>
                    @endif {{-- <-- @endif QUE FALTAVA --}}
                </div>
            @endif {{-- <-- @endif QUE FALTAVA --}}
        </div>

        <div class="flex items-center gap-4">
            {{-- MUDANÇA: Botão maior e com fonte maior --}}
            <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-base text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Salvar') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section> {{-- <-- FIM DO FICHEIRO QUE FALTAVA --}}