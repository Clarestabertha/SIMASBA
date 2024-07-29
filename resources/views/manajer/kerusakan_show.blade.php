<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            function swapImage(clickedImg) {
                var mainImg = document.getElementById('mainImage');
                var mainImgSrc = mainImg.src;
                mainImg.src = clickedImg.src;
                clickedImg.src = mainImgSrc;
            }
        </script>
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Kerusakan Bangunan dan Stasiun
                </h2>
            </div>
            <div class="bg-ketiga rounded-lg shadow-md p-8 mt-8 max-w-4xl mx-auto">
                <div class="flex">
                    <!-- Gambar Utama -->
                    <div class="sm:w-1/5 mt-5">
                        <img id="mainImage" src="/storage/kerusakan/test.jpg" alt="Foto Kerusakan" class="rounded-lg shadow-lg">
                    </div>
                    <!-- Informasi Kerusakan -->
                    <div class="md:w-2/3 md:ml-8 mt-10">
                        <p class="mb-4">Nama Pengirim: Siapa</p>
                        <p class="mb-4">Tanggal: 17/07/2024</p>
                        <p class="mb-4">Sumber Laporan: Kepala Stasiun</p>
                        <p class="mb-4">Lokasi: Stasiun Sidareja</p>
                        <p class="mb-4">Deskripsi: Laporan kerusakan via WhatsApp perihal penutup atap overkaping stasiun terlepas, sehingga ada lubang lubang di bagaiatan atap di atas peron</p>
                        <p class="mb-4">Personil: Edi dan Yan</p>
                    </div>
                </div>
                <!-- Galeri Gambar -->
                <div class="flex justify-start mt-8 space-x-2 overflow-x-auto">
                    <img src="/storage/kerusakan/test 2.jpg" alt="Foto Kerusakan 1" class="w-20 rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                    <img src="/storage/kerusakan/test.jpg" alt="Foto Kerusakan 2" class="w-20 rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                    <img src="/storage/kerusakan/test.jpg" alt="Foto Kerusakan 3" class="w-20 rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                    <img src="/storage/kerusakan/test.jpg" alt="Foto Kerusakan 4" class="w-20 rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                    <img src="/storage/kerusakan/test.jpg" alt="Foto Kerusakan 5" class="w-20 rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                    <img src="/storage/kerusakan/test.jpg" alt="Foto Kerusakan 6" class="w-20 rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                </div>
                <!-- Pertanyaan dan Tombol Aksi -->
                <div class="flex flex-col items-center mt-20 space-y-4">
                    <p class="font-bold text-lg">Apakah anda menyutujui laporan ini?</p>
                    <div class="flex space-x-4 mt-5">
                        <x-primary-button class="bg-red-500 text-white px-4 py-2 rounded-lg">Tidak</x-primary-button>
                        <x-secondary-button class="bg-blue-700 text-white px-4 py-2 rounded-lg">Setuju</x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
