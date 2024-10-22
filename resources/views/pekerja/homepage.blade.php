<x-app-layout>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Gambar mengapung ke kanan -->
    <div class="relative mt-8">
        <img src="{{ asset('/storage/img/home-pekerja.png') }}" alt="Konten Pekerja" class="w-2/3 ml-4 mb-8 mt-8 float-right">
        <div class="absolute top-0 left-0 mt-2 ml-4 bg-white bg-opacity-75 p-4 rounded-lg">
            <p class="text-secondary text-3xl font-bold">
                Selamat Datang<br>
                <span class="text-primary text-3xl font-bold">{{ Auth::user()->name }}</span>
            </p>
        </div>
    </div>

    <div class="clear-both text-center mt-40 my-8"> 
        <h2 class="text-3xl font-bold">Apa yang bisa Kamu Lakukan?</h2>
    </div>

    <!-- Wrapper for centering -->
    <div class="flex flex-col items-center gap-8 w-full max-w-4xl mx-auto">
        <!-- Row 1 -->
        <div class="flex justify-center gap-8 w-full">
            <!-- Card 1 -->
            <a href="#jadwal-proyek" class="w-full sm:w-1/2 lg:w-2/3">
                <div class="gradient-card-1 rounded-3xl shadow-lg p-8 flex items-center space-x-4 min-h-[200px] h-full">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('/storage/img/jadwal.png') }}" alt="Jadwal Proyek" class="h-16 w-16">
                    </div>
                    <div>
                        <h3 class="text-white text-xl font-bold">Jadwal Proyek</h3>
                        <p class="text-white">Kamu dapat melihat jadwal Proyek yang harus kamu kerjakan</p>
                    </div>
                </div>
            </a>

            <!-- Card 2 -->
            <div class="w-full sm:w-1/2 lg:w-2/3 gradient-card-3 rounded-3xl shadow-lg p-8 flex items-center space-x-4 min-h-[200px] h-full">
                <div class="flex-shrink-0">
                    <img src="{{ asset('/storage/img/panduan-card.png') }}" alt="Panduan" class="h-12 w-12">
                </div>
                <div>
                    <h3 class="text-white text-xl font-bold">Panduan</h3>
                    <p class="text-white">Kamu dapat melihat Panduan pada Navigation Bar untuk membantumu menggunakan SIMASBA</p>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="flex justify-center gap-8 w-full">
            <!-- Card 3 -->
            <div class="w-full sm:w-1/2 lg:w-2/3 gradient-card-5 rounded-3xl shadow-lg p-8 flex items-center space-x-4 min-h-[200px] h-full">
                <div class="flex-shrink-0">
                    <img src="{{ asset('/storage/img/kerusakan-card.png') }}" alt="Kerusakan" class="h-12 w-12">
                </div>
                <div>
                    <h3 class="text-white text-xl font-bold">Kerusakan</h3>
                    <p class="text-white">Kamu dapat membuat Laporan Kerusakan</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="w-full sm:w-1/2 lg:w-2/3 gradient-card-4 rounded-3xl shadow-lg p-8 flex items-center space-x-4 min-h-[200px] h-full">
                <div class="flex-shrink-0">
                    <img src="{{ asset('/storage/img/tindak-lanjut.png') }}" alt="Tindak Lanjut" class="h-16 w-16">
                </div>
                <div>
                    <h3 class="text-white text-xl font-bold">Tindak Lanjut</h3>
                    <p class="text-white">Kamu dapat membuat Laporan Tindak Lanjut setelah menyelesaikan Proyek</p>
                </div>
            </div>
        </div>
    </div>
    

    <div id="jadwal-proyek" class="clear-both text-center my-8">
        <h2 class="text-3xl font-bold text-primary mt-40">Jadwal Proyek Kamu</h2>
    </div>

    <div class="flex justify-center mt-5">
        <div class="w-full max-w-4xl overflow-x-auto shadow rounded-lg">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                            Tanggal
                        </th>
                        <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                            Lokasi Perbaikan
                        </th>
                        <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                            Personel
                        </th>
                        <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                            Selesai
                        </th>
                    </tr>
                </thead>
                <tbody id="tindaklanjut-table">
                    @foreach($kerusakan as $item)
                    <tr id="row-{{ $item->id_kerusakan }}">
                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $item->tanggal }}</p>
                        </td>
                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $item->lokasi }}</p>
                        </td>
                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $item->personel }}</p>
                        </td>
                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                            <a href="{{ route('tindaklanjut.input', ['id_kerusakan' => $item->id_kerusakan]) }}">
                                <input type="checkbox" class="completed-checkbox" data-id="{{ $item->id_kerusakan }}">
                            </a>
                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center my-12 mt-40">
        <p class="text-3xl font-medium text-primary">Mari Berkenalan dengan Tim Manajemen Kami!</p>
        <p class="text-sm mt-5 px-24">Kami dengan bangga memperkenalkan Manajer dan Asisten Manajer kami yang berdedikasi untuk memastikan keberhasilan operasional dan pemeliharaan bangunan serta stasiun.</p>
    </div>

    <div class="flex justify-center space-x-10 p-8">
        <!-- Card 1 -->
        <div class="max-w-xs gradient-card-3 shadow-md rounded-lg overflow-hidden relative">
    <img src="/storage/img/5.png" alt="Orang 2" class="w-3/4 mx-auto">
    <div class="bg-secondary text-center p-3 w-3/4 absolute bottom-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
        <p class="text-primary font-bold text-lg">Yuni Edi</p>
        <p class="text-white text-xs">Manajer Bangunan Dinas</p>
    </div>
</div>

        <div class="max-w-xs gradient-card-3 shadow-md rounded-lg overflow-hidden relative">
    <img src="/storage/img/3.png" alt="Orang 2" class="w-3/4 mx-auto">
    <div class="bg-secondary text-center p-3 w-3/4 absolute bottom-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
        <p class="text-primary font-bold text-lg">Handrawan N.</p>
        <p class="text-white text-xs">Asisten Manajer Stasiun</p>
    </div>
</div>


<div class="max-w-xs gradient-card-3 shadow-md rounded-lg overflow-hidden relative">
    <img src="/storage/img/4.png" alt="Orang 2" class="w-3/4 mx-auto">
    <div class="bg-secondary text-center p-3 w-3/4 absolute bottom-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
        <p class="text-primary font-bold text-lg">Wendy A.</p>
        <p class="text-white text-xs">Asisten Manajer Non Stasiun</p>
    </div>
</div>

<div class="max-w-xs gradient-card-3 shadow-md rounded-lg overflow-hidden relative">
    <img src="/storage/img/2.png" alt="Orang 2" class="w-3/4 mx-auto">
    <div class="bg-secondary text-center p-3 w-3/4 absolute bottom-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
        <p class="text-primary font-bold text-lg">Adi Purwanto</p>
        <p class="text-white text-xs">Asisten Manajer ME</p>
    </div>
</div>
    </div>

    <script>
    document.querySelectorAll('.completed-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        let row = this.closest('tr');
        if (this.checked) {
            let id = this.getAttribute('data-id');
            fetch("{{ route('update.selesai') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id_kerusakan: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect ke halaman insert tindak lanjut setelah berhasil
                    window.location.href = "{{ url('input_tindaklanjut') }}/" + id; // Ganti URL sesuai dengan route yang Anda gunakan
                } else {
                    alert('Failed to update status');
                    this.checked = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update status');
                this.checked = false;
            });
        } else {
            row.style.display = '';
        }
    });
});

</script>

</x-app-layout>
