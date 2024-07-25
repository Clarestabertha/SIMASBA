<x-app-layout>
    <x-slot name="header">
        <!-- Header content, if needed -->
    </x-slot>

    <!-- Konten utama dengan teks di atas gambar -->
    <div class="relative">
        <!-- Gambar latar belakang -->
        <img src="{{ asset('/storage/img/konten dashboard manajer.png') }}" class="object-cover w-full h-full" alt="Konten Manajer">

        <!-- Teks Selamat Datang Manajer -->
        <div class="absolute inset-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
                <div class="sm:rounded-lg bg-opacity-50 text-black text-center text-3xl p-24 font-medium">
                    {{ __("Selamat Datang Manajer") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Card container placed below the background image -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12"> <!-- Added space-y-12 for vertical spacing -->
            <!-- Row 1 -->
            <div class="flex justify-center space-x-16">
                <!-- Card 1 -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-128 h-80">
                    <div class="p-6 text-black text-center text-2xl">
                        {{ __("Diagram Kerusakan") }}
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-96 h-80 flex flex-col justify-center items-center">
                    <div class="text-9xl text-primary font-semibold text-center">
                        200
                    </div>
                    <div class="mt-25 p-6 text-black text-center text-lg font-bold">
                        {{ __("Data Kerusakan") }}
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="flex justify-center space-x-16">
                <!-- Duplicate Card 1 -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-128 h-80">
                    <div class="p-6 text-black text-center text-2xl">
                        {{ __("Diagram Tindak Lanjut") }}
                    </div>
                </div>
                <!-- Duplicate Card 2 -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-96 h-80 flex flex-col justify-center items-center">
                    <div class="text-9xl text-primary font-semibold text-center">
                        200
                    </div>
                    <div class="mt-25 p-6 text-black text-center text-lg font-bold">
                        {{ __("Data Tindak Lanjut") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
