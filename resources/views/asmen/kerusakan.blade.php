<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Kerusakan Bangunan dan Gedung
                </h2>
            </div>
            <div class="flex justify-center">
                <div class="w-full max-w-4xl px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="my-2 flex flex-row-reverse mt-20">
                        <div class="relative w-50">
                            <form method="GET" action="{{ route('kerusakan.indexasisten') }}">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-black ml-1">
                                        <path d="M10 2a8 8 0 015.293 13.707L22 21.414 20.586 23l-6.707-6.707A8 8 0 1110 2zm0 2a6 6 0 100 12A6 6 0 0010 4z"></path>
                                    </svg>
                                </span>
                                <input name="search" placeholder="Cari data" class="appearance-none rounded-full border-2 border-black block pl-10 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-black focus:bg-white focus:placeholder-primary focus:text-gray-700 focus:outline-none" value="{{ Request::get('search') }}" />
                            </form>
                        </div>
                    </div>
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden mt-5">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Nama</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Tanggal</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Sumber Laporan</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Lokasi Kerusakan</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Status</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disetujui as $k)
                                    <tr class="bg-white">
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->nama_pelapor }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->tanggal }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->sumber_laporan }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->lokasi }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->status }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <a href="{{ route('kerusakan.asmen.show', $k->id_kerusakan) }}">
                                                <i class="fas fa-info-circle text-blue-500 h-6 w-6 fa-2x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $disetujui->appends(['ditolak_page' => $ditolak->currentPage()])->links() }}
                        </div>
                    </div>

                    <!-- Tabel Ditolak -->
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden mt-5">
                    <h2 class="text-2xl font-bold leading-tight text-center gradient-text mb-6">
                        Laporan yang Ditolak
                    </h2>                         <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Nama</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Tanggal</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Sumber Laporan</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Lokasi Kerusakan</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Status</th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ditolak as $k)
                                    <tr class="bg-gray-200">
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->nama_pelapor }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->tanggal }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->sumber_laporan }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->lokasi }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">{{ $k->status }}</td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <a href="{{ route('kerusakan.asmen.show', $k->id_kerusakan) }}">
                                                <i class="fas fa-info-circle text-blue-500 h-6 w-6 fa-2x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $ditolak->appends(['disetujui_page' => $disetujui->currentPage()])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
