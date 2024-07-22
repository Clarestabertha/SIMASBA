<x-guest-layout>
    <div class="bg-white min-h-screen flex">
        <!-- Bagian Gambar -->
        <div class="flex-1 flex items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0" style="background-image: url('{{ asset('/storage/img/register.png') }}'); background-size: 100% 100%; background-repeat: no-repeat; background-position: center;"></div>
        </div>

        <!-- Bagian Formulir -->
        <div class="flex-1 flex flex-col items-center justify-center p-4">
            <!-- Logo KAI -->
            <img src="{{ asset('/storage/img/logo kai.png') }}" alt="Logo KAI" class="w-40">
            <p class="text-2xl font-bold mb-6">Registrasi</p>

            <!-- Formulir Pendaftaran -->
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-md">
                @csrf

                <!-- Nama -->
                <div class="mb-6">
                    <x-input-label for="name" :value="__('Name')" class="text-black" />
                    <x-text-input id="name" class="block mt-1 w-full border border-black bg-white p-3 rounded" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Alamat Email -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" class="text-black" />
                    <x-text-input id="email" class="block mt-1 w-full border border-black bg-white p-3 rounded" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Kata Sandi -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" class="text-black" />
                    <x-text-input id="password" class="block mt-1 w-full border border-black bg-white p-3 rounded" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-black" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border border-black bg-white p-3 rounded" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button class="ms-4 bg-secondary">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>