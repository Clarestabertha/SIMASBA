<x-app-layout>
    <x-slot name="header">
        <!-- Header content, if needed -->
    </x-slot>

    <!-- Konten utama dengan teks di atas gambar -->
    <div class="relative">
        <!-- Gambar latar belakang -->
        <img src="{{ asset('/storage/img/konten dashboard manajer.png') }}" class="object-cover w-full h-96" alt="Konten Manajer">

        <!-- Teks Selamat Datang Manajer -->
        <div class="absolute inset-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
                <div class="sm:rounded-lg bg-opacity-50 text-black text-center text-2xl p-6">
                    {{ __("Selamat Datang Manajer") }}
                </div>
            </div>
        </div>
    </div>


    <!-- Card container placed below the background image -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full max-w-md mx-auto bg-ketiga shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-black text-center text-2xl">
                    <!-- Card content here -->
                    {{ __("Informasi Card") }}
                </div>
            </div>
            <div class="w-full max-w-md mx-auto bg-ketiga shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-black text-center text-2xl">
                    <!-- Card content here -->
                    {{ __("Informasi Card") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
