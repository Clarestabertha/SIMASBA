<x-app-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Kerusakan Bangunan dan Gedung
                </h2>
            </div>
            <div class="bg-ketiga rounded-lg shadow-md p-8 mt-8 max-w-4xl mx-auto">
                <div class="flex">
                    <!-- Gambar Utama -->
                    <div class="sm:w-1/3 mt-5 flex items-center justify-center">
                        @if (!empty($kerusakan->foto_kerusakan[0]))
                            <img id="mainImage" src="{{ asset('storage/' . $kerusakan->foto_kerusakan[0]) }}" alt="Foto Kerusakan" class="rounded-lg shadow-lg w-full h-auto object-cover">
                        @else
                            <p>Tidak ada gambar tersedia.</p>
                        @endif
                    </div>
                    <!-- Informasi Kerusakan -->
                    <div class="md:w-2/3 md:ml-8 mt-5">
                        <p class="mb-4"><strong>Nama Pengirim:</strong> {{ $kerusakan->nama_pelapor }}</p>
                        <p class="mb-4"><strong>Tanggal:</strong> {{ $kerusakan->tanggal }}</p>
                        <p class="mb-4"><strong>Sumber Laporan:</strong> {{ $kerusakan->sumber_laporan }}</p>
                        <p class="mb-4"><strong>Lokasi:</strong> {{ $kerusakan->lokasi }}</p>
                        <p class="mb-4"><strong>Deskripsi:</strong> {{ $kerusakan->deskripsi }}</p>
                        <p class="mb-4"><strong>Status:</strong> {{ $kerusakan->status }}</p>

                        <!-- Tampilkan personel dan tgl_perbaikan jika status sesuai -->
                        @if ($kerusakan->status === 'disetujui_asisten' || $kerusakan->status === 'disetujui'|| $kerusakan->status === 'ditolak'|| $kerusakan->status === 'ditolak_asisten')
                            <p class="mb-4"><strong>Personel:</strong> {{ $kerusakan->personel }}</p>
                            <p class="mb-4"><strong>Tanggal Perbaikan:</strong> {{ $kerusakan->tgl_perbaikan }}</p>
                        @endif
                        @if ($kerusakan->status === 'ditolak'|| $kerusakan->status === 'ditolak_asisten')
                        <p class="mb-4"><strong>Alasan Ditolak:</strong> {{ $kerusakan->alasan }}</p>
                        @endif
                    </div>
                </div>
                <!-- Galeri Gambar -->
                <div class="flex justify-start mt-8 space-x-2 overflow-x-auto">
                    @foreach ($kerusakan->foto_kerusakan as $foto)
                        <img src="{{ asset('storage/' . $foto) }}" alt="Foto Kerusakan" class="w-20 h-auto object-cover rounded-lg shadow-lg cursor-pointer" onclick="swapImage(this)">
                    @endforeach
                </div>
                <!-- Pertanyaan dan Tombol Aksi -->
                @if (auth()->user()->role === 'asisten_manajer' && !in_array($kerusakan->status, ['disetujui_asisten', 'ditolak_asisten', 'disetujui', 'ditolak']))
                    <div class="flex flex-col items-center mt-20 space-y-4">
                        <p class="font-bold text-lg">Apakah Anda menyetujui laporan ini?</p>
                        <div class="flex space-x-4 mt-5">
                            <x-primary-button class="bg-blue-500 text-white" onclick="openModal()">Setuju</x-primary-button>
                            <form method="POST" action="{{ route('kerusakan.reject_asisten', $kerusakan->id_kerusakan) }}">
                                @csrf
                                @method('PUT')
                                <x-secondary-button type="button" class="bg-red-500 text-white" onclick="openRejectModal()">Tidak</x-secondary-button>
                                </form>
                        </div>
                    </div>
                @elseif (auth()->user()->role === 'manajer' && !in_array($kerusakan->status, ['disetujui', 'ditolak','ditolak_asisten']))
                    <div class="flex flex-col items-center mt-20 space-y-4">
                        <p class="font-bold text-lg">Apakah Anda menyetujui laporan ini?</p>
                        <div class="flex space-x-4 mt-5">
                            <form method="POST" action="{{ route('kerusakan.approve_manajer', $kerusakan->id_kerusakan) }}">
                                @csrf
                                @method('PUT')
                                <x-primary-button class="bg-blue-500 text-white">Setuju</x-primary-button>
                            </form>
                            <form method="POST" action="{{ route('kerusakan.reject_manajer', $kerusakan->id_kerusakan) }}">
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

    <!-- Modal Disetujui-->
    <div id="approvalModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="relative p-5 border w-2/5 shadow-lg rounded-md bg-primary">
            <form id="approvalForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-white">Formulir Persetujuan</h3>
                    <div class="mt-2 px-7 py-3">
                        <div>
                            <label for="personel" class="block text-sm font-medium text-white text-left">Personel</label>
                            <input type="text" name="personel" id="personel" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mt-4">
                            <label for="tgl_perbaikan" class="block text-sm font-medium text-white text-left">Tanggal Perbaikan</label>
                            <input type="date" name="tgl_perbaikan" id="tgl_perbaikan" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="items-center px-4 py-3">
                        <x-primary-button class="bg-blue-500 text-white">Kirim</x-primary-button>
                        <x-third-button type="button" onclick="closeModal()">Batal</x-third-button>
                    </div>
                </div>
            </form>
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

        function openModal() {
            var form = document.getElementById('approvalForm');
            var role = '{{ auth()->user()->role }}';
            var actionUrl = '';

            if (role === 'asisten_manajer') {
                actionUrl = '{{ route('kerusakan.approve_asisten', $kerusakan->id_kerusakan) }}';
            } else if (role === 'manajer') {
                actionUrl = '{{ route('kerusakan.approve_manajer', $kerusakan->id_kerusakan) }}';
            }

            form.action = actionUrl;
            document.getElementById('approvalModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('approvalModal').classList.add('hidden');
        }

        function openRejectModal() {
    var form = document.getElementById('rejectForm');
    var role = '{{ auth()->user()->role }}';
    var actionUrl = '';

    if (role === 'asisten_manajer') {
        actionUrl = '{{ route('kerusakan.reject_asisten', $kerusakan->id_kerusakan) }}';
    } else if (role === 'manajer') {
        actionUrl = '{{ route('kerusakan.reject_manajer', $kerusakan->id_kerusakan) }}';
    }

    form.action = actionUrl;
    document.getElementById('rejectModal').classList.remove('hidden'); // Menampilkan modal
    console.log('Modal penolakan dibuka'); // Debug log
}

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden'); // Menyembunyikan modal
        }
    </script>
</x-app-layout>
