<section class="space-y-6">
    <header class="w-full">
        <h2 class="text-lg font-medium text-gray-900 border-b-2 border-abu pb-2">
            {{ __('Non Aktifkan Akun') }}
        </h2>

        <p class="mt-1 text-sm text-black mt-4">
            {{ __("Jika anda ingin menonaktifkan akun anda, silahkan tekan tombol “Nonaktifkan Akun” di bawah ini.") }}
        </p>
    </header>

    <x-secondary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Non Aktifkan Akun') }}</x-secondary-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('user.deactivate', $user->id) }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Apakah Anda yakin ingin menonaktifkan akun Anda?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Ketikkan kata sandi akun anda untuk mengkonfirmasi permintaan nonaktif akun anda') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Kata Sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-third-button x-on:click.prevent="$dispatch('close-modal', 'confirm-user-deletion')">
                    {{ __('Batal') }}
                </x-third-button>

                <x-primary-button class="ml-3">
                    {{ __('Non Aktifkan Akun') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
