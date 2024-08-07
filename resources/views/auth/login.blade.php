<x-guest-layout>
    <div class="bg-white min-h-screen flex">
        <!-- Bagian Formulir -->
        <div class="flex-1 flex flex-col items-center justify-center p-4">
        <img src="{{ asset('/storage/img/logo kai.png') }}" alt="Logo KAI" class="w-20 mb-2">
            <p class="text-2xl font-bold mb-6">Login</p>

            <form method="POST" action="{{ route('login') }}"class="w-full max-w-md">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-black" />
                    <x-text-input id="email" class="block mt-1 w-full border border-black bg-white p-3 rounded" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="text-black" />

                    <x-text-input id="password" class="block mt-1 w-full border border-black bg-white p-3 rounded"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('password.request') }}">
                            {{ __('Lupa Kata Sandi?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3 bg-secondary">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Bagian Gambar -->
        <div class="flex-1 flex items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0" style="background-image: url('{{ asset('/storage/img/login.png') }}'); background-size: 100% 100%; background-repeat: no-repeat; background-position: center;"></div>
        </div>
    </div>
</x-guest-layout>
