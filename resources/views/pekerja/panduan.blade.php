<x-app-layout>
<div class="flex items-center mt-8">
    <img src="/storage/img/panduan.png" class="w-[500px] ml-10">
    <div class="ml-10 p-6">
        <p class="font-medium text-3xl">Kamu berada di halaman panduan!</p>
        <p class="mt-4 text-lg">Halaman ini akan membantumu dalam menggunakan 
        website SIMASBA.</p>
    </div>
</div>

    <!-- Card Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 mt-20">
            <!-- Row 1 -->
            <div class="flex justify-center space-x-16">
                <!-- Card 1: Jadwal Proyek -->
                <a href="#jadwal-proyek" class="w-96 h-24 gradient-card-1 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center no-underline">
                    <div class="p-6 w-full h-full flex items-center justify-center space-x-3">
                        <img src="/storage/img/jadwal proyek.png">
                        <p class="text-white font-semibold text-2xl">Jadwal Proyek</p>
                    </div>
                </a>

                <!-- Card 2: Tim Manajemen -->
                <a href="#tim-manajemen" class="w-96 h-24 gradient-card-3 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center no-underline">
                    <div class="p-6 w-full h-full flex items-center justify-center space-x-3">
                        <img src="/storage/img/tim.png">
                        <p class="text-white font-semibold text-2xl">Tim Manajemen</p>
                    </div>
                </a>
            </div>

            <!-- Row 2 -->
            <div class="flex justify-center space-x-16">
                <!-- Card 1: Kerusakan -->
                <a href="#kerusakan" class="w-96 h-24 gradient-card-3 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center no-underline">
                    <div class="p-6 w-full h-full flex items-center justify-center space-x-10">
                        <img src="/storage/img/kerusakan.png">
                        <p class="text-white font-semibold text-2xl">Kerusakan</p>
                    </div>
                </a>

                <!-- Card 2: Tindak Lanjut -->
                <a href="#tindak-lanjut" class="w-96 h-24 gradient-card-1 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center no-underline">
                    <div class="p-6 w-full h-full flex items-center justify-center space-x-3">
                        <img src="/storage/img/tl.png">
                        <p class="text-white font-semibold text-2xl">Tindak Lanjut</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- jadwal proyek -->
    <div id="jadwal-proyek" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-20">
            <!-- Single Card -->
            <div class="w-full max-w-4xl mx-auto bg-keempat shadow-lg rounded-3xl overflow-hidden">
                <div class="p-6">
                    <!-- Centered Title -->
                    <div class="text-center mb-5">
                        <p class="text-secondary font-semibold text-2xl">Jadwal Proyek</p>
                    </div>
                    <!-- Left Aligned Content -->
                    <div class="space-y-2">
                        <p>1. Buka Menu “Beranda” pada Navigasi di ujung atas halaman ini.</p>
                        <p>2. Jika sudah masuk ke Beranda, kemudian scroll ke bawah dan kamu akan menemukan Tabel “Jawal Proyek”.</p>
                        <p>3. Tabel tersebut menampilkan jadwal dari tiap pengguna mengenai proyek yang harus diselesaikan.</p>
                        <p>4. Tabel berisi Informasi Proyek, yaitu Tanggal Proyek dimulai, Lokasi Proyek, dan juga personel / tim yang mengerjakan proyek tersebut.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tim Manajemen -->
    <div id="tim-manajemen" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
            <!-- Single Card -->
            <div class="w-full max-w-4xl mx-auto bg-ketiga shadow-lg rounded-3xl overflow-hidden">
                <div class="p-6">
                    <!-- Centered Title -->
                    <div class="text-center mb-5">
                        <p class="text-primary font-semibold text-2xl">Tim Manajemen</p>
                    </div>
                    <!-- Left Aligned Content -->
                    <div class="space-y-2">
                        <p>1. Buka Menu “Beranda” pada Navigasi di ujung atas halaman ini.</p>
                        <p>2. Jika sudah masuk ke Beranda, kemudian scroll ke bawah hingga menemukan beberapa foto.</p>
                        <p>3. Informasi berisi Nama dan juga jabatan.</p>
                        <p>4. Nomor Hp dari Asisten Manajer dapat dilihat pada Footer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kerusakan -->
    <div id="kerusakan" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
            <!-- Single Card -->
            <div class="w-full max-w-4xl mx-auto bg-ketiga shadow-lg rounded-3xl overflow-hidden">
                <div class="p-6">
                    <!-- Centered Title -->
                    <div class="text-center mb-5">
                        <p class="text-primary font-semibold text-2xl">Kerusakan</p>
                    </div>
                    <!-- Left Aligned Content -->
                    <div class="space-y-2">
                        <p>1. Buka Menu "Kerusakan" pada Navigasi di ujung atas halaman ini.</p>
                        <p>2. Menu ini berfungsi untuk melaporakan kerusakan pada Stasiun ataupun Bangunan Dinas.</p>
                        <p>3. Pada menu ini kamu dapat melihat laporan yang sudah kamu kirim, beserta status dari laporan tersebut, yaitu “Belum dibaca”, “Diterima”, atau “Ditolak”.</p>
                        <p>4. Untuk menambahkan Laporan Kerusakan baru, tekan tombol “Tambahkan Laporan Kerusakan”.</p>
                        <p>5. Setelah menekan tombol,  kamu akan dialihkan ke Formulir Laporan Kerusakan.</p>
                        <p>6. Formulir harus di isi dengan lengkap agar bisa di kirim.</p>
                        <p>7. Tanggal di isi dengan tanggal laporan tersebut dibuat.</p>
                        <p>8. Sumber laporan berisi nama orang atau tim yang melaporkan kerusakan tersebut.</p>
                        <p>9. Lokasi Kerusakan di isi Nama Stasiun / Nama Bangunan Dinas, kemudian spesifikasi lokasi. contoh: Stasiun Purwokerto (Peron 2 rusak).</p>
                        <p>10. Deskripsi Kerusakan di isi dengan kalimat penjelas mengenai kerusakan yang terjadi.</p>
                        <p>11. Foto Kerusakan paling sedikit 1 foto, dan paling banyak 5 foto.</p>
                        <p>12. Selanjutnya tekan tombol “Kirim” pada bagian kanan bawah untuk mengirimkan Laporan Kerusakan tersebut.</p>
                        <p>13. Untuk melihat informasi lengkap dari laporaran yang sudah kamu kirim, tekan ikon “i” pada kolom aksi.</p>
                        <p>14. Jika Laporan Kerusakan yang kamu kirim terdapat kesalahan penulisan maupun kesalahan lainnya, kamu dapat menghapus laporan tersebut dan mengisi formulir kembali.</p>
                        <p>15. Untuk menghapus laporan yang sudah kamu kirim, tekan ikon “tempat sampah” pada kolom aksi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tindak Lanjut -->
    <div id="tindak-lanjut" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-14">
            <!-- Single Card -->
            <div class="w-full max-w-4xl mx-auto bg-keempat shadow-lg rounded-3xl overflow-hidden">
                <div class="p-6">
                    <!-- Centered Title -->
                    <div class="text-center mb-5">
                        <p class="text-secondary font-semibold text-2xl">Tindak Lanjut</p>
                    </div>
                    <!-- Left Aligned Content -->
                    <div class="space-y-2">
                        <p>1. Buka Menu "Tindak Lanjut" pada Navigasi di ujung atas halaman ini.</p>
                        <p>2. Menu ini berfungsi untuk mengirimkan Laporan Tindak Lanjut yang telah dilakukan kepada Laporan Kerusakan yang dikirim oleh Pekerja Lapangan.</p>
                        <p>3. Tindak Lanjut ini dilakukan oleh Asisten Manajer / Mandor / Pelaksana Lapangan.</p>
                        <p>4. Pilih laporan Kerusakan yang sudah ditangani pada tabel “Laporan Kerusakan”.</p>
                        <p>5. Jika sudah selesai, tekan tombol “Tambahkan Tindak Lanjut”.</p>
                        <p>6. Formulir Tindak Lanjut harus diisi dengan lengkap agar bisa dikirim.</p>
                        <p>7. Tanggal di isi dengan tanggal laporan tersebut dibuat.</p>
                        <p>8. Sumber laporan berisi nama orang atau tim yang melakukan tindak lanjut tersebut.</p>
                        <p>9. Lokasi Kerusakan di isi Nama Stasiun / Nama Bangunan Dinas, kemudian spesifikasi lokasi. contoh: Stasiun Purwokerto (Peron 2 rusak).</p>
                        <p>10. Deskripsi Tindak Lanjut di isi dengan kalimat penjelas mengenai tindakan yang telah diambil untuk menangani kerusakan tersebut.</p>
                        <p>11. Foto Kerusakan paling sedikit 1 foto, dan paling banyak 5 foto.</p>
                        <p>12. Selanjutnya tekan tombol “Kirim” pada bagian kanan bawah untuk mengirimkan Laporan Tindak Lanjut tersebut.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
