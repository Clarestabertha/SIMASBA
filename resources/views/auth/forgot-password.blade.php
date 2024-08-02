<x-guest-layout>
    <!-- Card Container -->
    <div class="max-w-md mx-auto gradient-card-1 p-6 rounded-lg shadow-lg">
        <!-- Card Title and Description -->
        <div class="mb-4 text-sm text-black dark:text-black" style="text-align: justify;">
            <span class="text-lg font-bold">{{ __('Lupa kata sandi?') }}</span> <br>
            {{ __('Tidak masalah. Beri tahu kami alamat email Anda, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi sehingga Anda bisa membuat yang baru..') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Password Reset Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-secondary-button>
                    {{ __('Kirim Tautan Reset Kata Sandi') }}
                </x-secondary-button>
            </div>
        </form>
    </div>
</x-guest-layout>