<x-guest-layout>
    <div class="bg-white min-h-screen flex">
        <!-- Bagian Gambar -->
        <div class="flex-1 flex items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0" style="background-image: url('{{ asset('/storage/img/register.png') }}'); background-size: 100% 100%; background-repeat: no-repeat; background-position: center;"></div>
        </div>

        <!-- Bagian Formulir -->
        <div class="flex-1 flex flex-col items-center justify-center p-4">
            <!-- Logo KAI -->
            <img src="{{ asset('/storage/img/logo kai.png') }}" alt="Logo KAI" class="w-40 mb-2">
            <p class="text-2xl font-bold mb-1">Registrasi</p>

            <!-- Formulir Pendaftaran -->
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-md">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" class="block mt-1 w-full border p-2 rounded" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Alamat Email -->
                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input id="email" class="block mt-1 w-full border p-2 rounded" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <x-input-label for="role" :value="__('Role')"/>
                    <select id="role" name="role" class="block mt-1 w-full p-3 rounded-full dark:border-black dark:bg-white dark:text-black focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" style="border-width: 1.5px; border-color: black;">
                        <option value="manajer" {{ old('role') === 'manajer' ? 'selected' : '' }}>Manajer</option>
                        <option value="asisten_manajer" {{ old('role') === 'asisten_manajer' ? 'selected' : '' }}>Asisten Manajer</option>
                        <option value="pekerja_lapangan" {{ old('role') === 'pekerja_lapangan' ? 'selected' : '' }}>Pekerja Lapangan</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>

                <!-- Kata Sandi -->
                <div class="mb-3">
                    <x-input-label for="password" :value="__('Kata Sandi')" />
                    <x-text-input id="password" class="block mt-1 w-full border p-2 rounded" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="mb-3">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border p-2 rounded" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                        {{ __('Sudah Pernah Masuk?') }}
                    </a>
                    <x-primary-button class="ms-4">
                        {{ __('Kirim') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
