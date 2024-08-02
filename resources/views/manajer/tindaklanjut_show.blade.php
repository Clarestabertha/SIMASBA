<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Tindak Lanjut Kerusakan
                </h2>
            </div>
            <div class="bg-ketiga rounded-lg shadow-md p-8 mt-8 max-w-4xl mx-auto">
                <div class="flex">
                    <!-- Gambar Utama -->
                    <div class="sm:w-1/3 mt-5">
                        @if (!empty($tindaklanjut->foto[0]))
                            <img id="mainImage" src="{{ asset('storage/' . $tindaklanjut->foto[0]) }}" alt="Foto Tindak Lanjut" class="rounded-lg shadow-lg w-full h-full object-cover">
                        @else
                            <p>Tidak ada gambar tersedia.</p>
                        @endif
                    </div>
                    <!-- Informasi Tindak Lanjut -->
                    <div class="md:w-2/3 md:ml-8 mt-5">
                        <p class="mb-4"><strong>Nama Pengirim:</strong> {{ $tindaklanjut->nama_pelapor }}</p>
                        <p class="mb-4"><strong>Tanggal:</strong> {{ $tindaklanjut->tanggal }}</p>
                        <p class="mb-4"><strong>Lokasi:</strong> {{ $tindaklanjut->lokasi }}</p>
                        <p class="mb-4"><strong>Ditujukkan kepada:</strong> {{ $tindaklanjut->untuk }}</p>
                        <p class="mb-4"><strong>Deskripsi:</strong> {{ $tindaklanjut->deskripsi }}</p>
                        <p class="mb-4"><strong>Personel:</strong> {{ $tindaklanjut->personel }}</p>
                        <p class="mb-4"><strong>Sumber:</strong> {{ $tindaklanjut->sumber }}</p>
                        <p class="mb-4"><strong>Status:</strong> {{ $tindaklanjut->status }}</p>
                    </div>
                </div>
                <!-- Galeri Gambar -->
                <div class="flex justify-start mt-8 space-x-2 overflow-x-auto">
                    @foreach ($tindaklanjut->foto as $fotos)
                        <img src="{{ asset('storage/' . $fotos) }}" alt="Foto Tindak Lanjut" class="w-20 h-20 object-cover rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                    @endforeach
                </div>
                <!-- Pertanyaan dan Tombol Aksi -->
                @if (auth()->user()->role === 'asisten_manajer' && !in_array($tindaklanjut->status, ['disetujui_asisten', 'ditolak_asisten', 'disetujui', 'ditolak']))
                    <div class="flex flex-col items-center mt-20 space-y-4">
                        <p class="font-bold text-lg">Apakah Anda menyetujui laporan ini?</p>
                        <div class="flex space-x-4 mt-5">
                            <form method="POST" action="{{ route('tindaklanjut.approve_asisten', $tindaklanjut->id_tl) }}">
                                @csrf
                                @method('PUT')
                                <x-primary-button class="bg-blue-500 text-white">Setuju</x-primary-button>
                            </form>
                            <form method="POST" action="{{ route('tindaklanjut.reject_asisten', $tindaklanjut->id_tl) }}">
                                @csrf
                                @method('PUT')
                                <x-secondary-button class="bg-red-500 text-white">Tidak</x-secondary-button>
                            </form>
                        </div>
                    </div>
                @elseif (auth()->user()->role === 'manajer' && !in_array($tindaklanjut->status, ['disetujui', 'ditolak']))
                    <div class="flex flex-col items-center mt-20 space-y-4">
                        <p class="font-bold text-lg">Apakah Anda menyetujui laporan ini?</p>
                        <div class="flex space-x-4 mt-5">
                            <form method="POST" action="{{ route('tindaklanjut.approve_manajer', $tindaklanjut->id_tl) }}">
                                @csrf
                                @method('PUT')
                                <x-primary-button class="bg-blue-500 text-white">Setuju</x-primary-button>
                            </form>
                            <form method="POST" action="{{ route('tindaklanjut.reject_manajer', $tindaklanjut->id_tl) }}">
                                @csrf
                                @method('PUT')
                                <x-secondary-button class="bg-red-500 text-white">Tidak</x-secondary-button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function swapImage(element) {
            var mainImage = document.getElementById('mainImage');
            mainImage.src = element.src;
        }
    </script>
</x-app-layout>
