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
                    <div class="sm:w-1/3 mt-5 flex items-center justify-center">
    @if (!empty($tindaklanjut->foto[0]))
        <img id="mainImage" src="{{ asset('storage/' . $tindaklanjut->foto[0]) }}" alt="Foto Tindak Lanjut" class="rounded-lg shadow-lg w-full h-auto object-cover">
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
                        @if ($tindaklanjut->status === 'disetujui_asisten' || $tindaklanjut->status === 'ditolak'|| $tindaklanjut->status === 'ditolak_asisten')
                        <p class="mb-4"><strong>Alasan Ditolak:</strong> {{ $tindaklanjut->alasan }}</p>
                        @endif
                    </div>
                </div>
                <!-- Galeri Gambar -->
                <div class="flex justify-start mt-8 space-x-2 overflow-x-auto">
                    @foreach ($tindaklanjut->foto as $fotos)
                        <img src="{{ asset('storage/' . $fotos) }}" alt="Foto Tindak Lanjut" class="w-20 h-auto object-cover rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
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
                                <x-secondary-button type="button" class="bg-red-500 text-white" onclick="openRejectModal()">Tidak</x-secondary-button>
                            </form>
                        </div>
                    </div>
                @elseif (auth()->user()->role === 'manajer' && !in_array($tindaklanjut->status, ['disetujui', 'ditolak','ditolak_asisten']))
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
                                <x-secondary-button type="button" class="bg-red-500 text-white" onclick="openRejectModal()">Tidak</x-secondary-button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

<!-- Modal Ditolak -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="relative p-5 border w-2/5 shadow-lg rounded-md bg-primary">
            <form id="rejectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-white">Formulir Penolakan</h3>
                    <div class="mt-2 px-7 py-3">
                        <div>
                            <label for="alasan" class="block text-sm font-medium text-white text-left">Alasan</label>
                            <input type="text" name="alasan" id="alasan" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="items-center px-4 py-3">
                        <x-primary-button class="bg-blue-500 text-white">Kirim</x-primary-button>
                        <x-third-button type="button" onclick="closeRejectModal()">Batal</x-third-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function swapImage(element) {
            var mainImage = document.getElementById('mainImage');
            mainImage.src = element.src;
        }
        function openRejectModal() {
    var form = document.getElementById('rejectForm');
    var role = '{{ auth()->user()->role }}';
    var actionUrl = '';

    if (role === 'asisten_manajer') {
        actionUrl = '{{ route('tindaklanjut.reject_asisten', $tindaklanjut->id_tl) }}';
    } else if (role === 'manajer') {
        actionUrl = '{{ route('tindaklanjut.reject_manajer', $tindaklanjut->id_tl) }}';
    }

    form.action = actionUrl;
    document.getElementById('rejectModal').classList.remove('hidden'); // Menampilkan modal
}

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden'); // Menyembunyikan modal
        }
    </script>
</x-app-layout>
