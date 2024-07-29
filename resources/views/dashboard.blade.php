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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            <!-- Row 1 -->
            <div class="flex justify-center space-x-16">
                <!-- Card 1: Grafik Kerusakan -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-128 h-80 flex items-center justify-center">
                    <div class="p-6 w-full h-full flex items-center justify-center">
                        <canvas id="kerusakanChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Card 2: Jumlah Kerusakan -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-96 h-80 flex flex-col justify-center items-center">
                    <div class="text-9xl text-primary font-semibold text-center">
                        {{ $totalKerusakan }}
                    </div>
                    <div class="mt-25 p-6 text-black text-center text-lg font-bold">
                        {{ __("Jumlah Data Kerusakan") }}
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="flex justify-center space-x-16">
                <!-- Card 1: Grafik Tindak Lanjut -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-128 h-80 flex items-center justify-center">
                    <div class="p-6 w-full h-full flex items-center justify-center">
                        <canvas id="tindaklanjutChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Card 2: Jumlah Tindak Lanjut -->
                <div class="max-w-md bg-ketiga shadow-md rounded-lg overflow-hidden w-96 h-80 flex flex-col justify-center items-center">
                    <div class="text-9xl text-primary font-semibold text-center">
                        {{ $totalTindaklanjut }}
                    </div>
                    <div class="mt-25 p-6 text-black text-center text-lg font-bold">
                        {{ __("Jumlah Data Tindak Lanjut") }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grafik Kerusakan per Bulan
        var ctxKerusakan = document.getElementById('kerusakanChart').getContext('2d');
        new Chart(ctxKerusakan, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Data Kerusakan',
                    data: {!! json_encode($valuesKerusakan) !!},
                    backgroundColor: 'rgba(45, 42, 108)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Tindak Lanjut per Bulan
        var ctxTindakLanjut = document.getElementById('tindaklanjutChart').getContext('2d');
        new Chart(ctxTindakLanjut, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Data Tindak Lanjut',
                    data: {!! json_encode($valuesTindaklanjut) !!},
                    backgroundColor: 'rgba(236, 106, 40)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    </script>

</x-app-layout>
