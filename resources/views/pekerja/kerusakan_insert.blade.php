<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center text-primary">
                    Formulir Laporan Kerusakan
                </h2>
            </div>
            <div class="flex justify-center items-center min-h-screen mt-20">
                <div class="w-full max-w-4xl bg-ketiga shadow-lg rounded-lg p-6">
                    <form action="{{ route('kerusakan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="tanggal" class="block text-black mb-2">Tanggal Laporan</label>
                            <input type="date" id="tanggal" name="tanggal" class="w-full border-2 border-gray-300 p-2 rounded-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="sumber_laporan" class="block text-black mb-2">Sumber Laporan</label>
                            <input type="text" id="sumber_laporan" name="sumber_laporan" class="w-full border-2 border-gray-300 p-2 rounded-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="lokasi" class="block text-black mb-2">Lokasi Kerusakan</label>
                            <input type="text" id="lokasi" name="lokasi" class="w-full border-2 border-gray-300 p-2 rounded-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-black mb-2">Deskripsi Kerusakan</label>
                            <textarea id="deskripsi" name="deskripsi" class="w-full border-2 border-gray-300 p-2 rounded-lg" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="foto_kerusakan" class="block text-black mb-2">Foto Kerusakan (maksimal 5 foto)</label>
                            <input type="file" id="foto_kerusakan" name="foto_kerusakan[]" class="w-full border-2 border-gray-300 p-2 rounded-full" multiple required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-primary transition duration-200">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
