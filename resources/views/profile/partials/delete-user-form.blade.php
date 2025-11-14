<section class="space-y-6">
    <header>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Excluir Conta') }}
        </h2>

        <p class="mt-2 mb-6 text-lg text-gray-600 dark:text-gray-400">
            {{ __('Depois que a sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados. Antes de excluir a sua conta, por favor, baixe quaisquer dados ou informações que você deseja manter.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
    >{{ __('Excluir Conta') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                {{ __('Tem a certeza que quer excluir a sua conta?') }}
            </h2>

            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
                {{ __('Uma vez que a sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados. Por favor, digite a sua senha para confirmar que você deseja excluir permanentemente a sua conta.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Senha') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 !text-lg"
                    placeholder="{{ __('Senha') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-base text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit" class="ms-3 inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __('Excluir Conta') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>