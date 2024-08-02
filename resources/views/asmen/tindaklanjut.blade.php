<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Tindak Lanjut Kerusakan
                </h2>
            </div>
            <div class="flex justify-center">
                <div class="w-full max-w-4xl px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="my-2 flex flex-row-reverse mt-20">
                        <div class="relative w-50">
                            <form method="GET" action="{{ route('tindaklanjut.index') }}">
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
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Nama
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Tanggal
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Lokasi
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Personel
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Sumber Laporan
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="user-table-body">
                                @php
                                    $dataSedang = $tindaklanjut->filter(function ($item) {
                                        return $item->status === 'sedang diproses';
                                    });
                                    $dataLainnya = $tindaklanjut->filter(function ($item) {
                                        return !in_array($item->status, ['sedang diproses']);
                                    });
                                @endphp

                                <!-- Data Sedang -->
                                @foreach($dataSedang->sortByDesc(function ($item) {
                                    return $item->status === 'disetujui_asisten' ? 1 : 0;
                                }) as $k)
                                    <tr class="bg-white">
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p>{{ $k->nama_pelapor }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->tanggal }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->lokasi }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->personel }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->sumber }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->status }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('tindaklanjut.asmen.show', $k->id_tl) }}" class="mx-2">
                                                    <i class="fas fa-info-circle text-blue-500 h-6 w-6 fa-2x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Data Lainnya -->
                                @foreach($dataLainnya->sortBy('tanggal') as $k)
                                    <tr class="bg-gray-200">
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p>{{ $k->nama_pelapor }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->tanggal }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->lokasi }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->personel }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->sumber }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $k->status }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('tindaklanjut.asmen.show', $k->id_tl) }}" class="mx-2">
                                                    <i class="fas fa-info-circle text-blue-500 h-6 w-6 fa-2x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        <div class="flex flex-1 justify-between sm:hidden">
                            @if ($tindaklanjut->onFirstPage())
                            <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 cursor-not-allowed">Previous</span>
                            @else
                            <a href="{{ $tindaklanjut->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                            @endif

                            @if ($tindaklanjut->hasMorePages())
                            <a href="{{ $tindaklanjut->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                            @else
                            <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 cursor-not-allowed">Next</span>
                            @endif
                        </div>

                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $tindaklanjut->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $tindaklanjut->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $tindaklanjut->total() }}</span>
                                results
                            </p>
                            </div>
                            <div>
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                @if ($tindaklanjut->onFirstPage())
                                <span class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.293 15.707a1 1 0 01-1.414 0L5.586 10l5.293-5.707a1 1 0 011.414 1.414L8.414 10l3.879 3.879a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                @else
                                <a href="{{ $tindaklanjut->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.293 15.707a1 1 0 01-1.414 0L5.586 10l5.293-5.707a1 1 0 011.414 1.414L8.414 10l3.879 3.879a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                @endif

                                <!-- Page number links -->
                                @for ($i = 1; $i <= $tindaklanjut->lastPage(); $i++)
                                <a href="{{ $tindaklanjut->url($i) }}" class="{{ $tindaklanjut->currentPage() == $i ? 'bg-primary text-white' : 'bg-white text-gray-500' }} relative inline-flex items-center border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-50">
                                    {{ $i }}
                                </a>
                                @endfor

                                @if ($tindaklanjut->hasMorePages())
                                <a href="{{ $tindaklanjut->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.707 4.293a1 1 0 011.414 0L14.414 10l-5.293 5.707a1 1 0 11-1.414-1.414L11.586 10 7.707 6.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                @else
                                <span class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.707 4.293a1 1 0 011.414 0L14.414 10l-5.293 5.707a1 1 0 11-1.414-1.414L11.586 10 7.707 6.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                @endif
                            </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
