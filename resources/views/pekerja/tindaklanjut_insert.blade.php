<x-app-layout>
<head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center text-primary">
                    Formulir Laporan Tindak Lanjut
                </h2>
            </div>
    <div class="flex justify-center items-center min-h-screene mt-20">
        <div class="w-full max-w-4xl bg-ketiga shadow-lg rounded-lg p-6">
        <form action="{{ route('tindaklanjut.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
                <div class="mb-4">
                    <label for="tanggal" class="block text-black mb-2">Tanggal Laporan</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full border-2 border-gray-300 p-2 rounded-full" required>
                </div>
                <div class="mb-4">
                    <label for="lokasi" class="block text-black mb-2">Lokasi Perbaikan</label>
                    <input type="text" id="lokasi" name="lokasi" class="w-full border-2 border-gray-300 p-2 rounded-full" required>
                </div>
                <div class="mb-4">
                    <label class="block text-black mb-2">Ditujukkan Kepada</label>
                    <div class="flex flex-col space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="manager_bangunan" name="untuk[]" value="manager_bangunan" class="mr-2">
                            Manager Bangunan (Yuni Edi)
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="asisten_manager_stasiun" name="untuk[]" value="asisten_manager_stasiun" class="mr-2">
                            Asisten Manager Stasiun (Handrawan)
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="asisten_manager_non_stasiun" name="untuk[]" value="asisten_manager_non_stasiun" class="mr-2">
                            Asisten Manajer Non Stasiun (Wendy)
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="asisten_manager_mechanikal_energetical" name="untuk[]" value="asisten_manager_mechanikal_energetical" class="mr-2">
                            Asisten Manajer Mekanikal Elektronikal (Adi Purwanto)
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-black mb-2">Deskripsi Tindak Lanjut</label>
                    <textarea id="deskripsi" name="deskripsi" class="w-full border-2 border-gray-300 p-2 rounded-lg" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="personel" class="block text-black mb-2">Personel</label>
                    <input type="text" id="personel" name="personel" class="w-full border-2 border-gray-300 p-2 rounded-full" required>
                </div>
                <div class="mb-4">
                    <label for="sumber" class="block text-black mb-2">Sumber Pelaporan dan Kerusakan</label>
                    <input type="text" id="sumber" name="sumber" class="w-full border-2 border-gray-300 p-2 rounded-full" required>
                </div>
                <div class="mb-4">
                    <label for="foto" class="block text-black mb-2">Foto Tindak Lanjut</label>
                    <input type="file" id="foto" name="foto[]" class="w-full border-2 border-gray-300 p-2 rounded-full" multiple required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-primary transition duration-200">Kirim</button>
                </div>
            </form>        
        </div>
    </div>
</x-app-layout>
