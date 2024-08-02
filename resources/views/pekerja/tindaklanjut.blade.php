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
                    <div class="my-2 flex justify-between mt-20">
                        <a href="{{ route('tindaklanjut.insert') }}" class="bg-primary text-white px-4 py-2 rounded-full hover:bg-secondary transition duration-200 flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Laporan Tindak Lanjut
                        </a>
                        <div class="relative w-50 flex items-center">
                            <form method="GET" action="{{ route('tindaklanjut.index') }}" class="flex items-center">
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
                                        Tanggal
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Lokasi Perbaikan
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
                                @foreach($tindaklanjut as $tl)
                                    <tr class="bg-white">
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $tl->tanggal }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $tl->lokasi }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $tl->personel }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $tl->sumber }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $tl->status }}</p>
                                        </td>
                                        <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                            <div class="flex justify-center space-x-2">
                                                <!-- Icon Detail -->
                                                <a href="{{ route('tindaklanjut.show', $tl->id_tl) }}" class="mx-2">
                                                    <i class="fas fa-info-circle text-blue-500 h-6 w-6 fa-2x"></i>
                                                </a>
                                                <!-- Icon Hapus -->
                                                <form method="POST" action="{{ route('tindaklanjut.destroy', $tl->id_tl) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="mx-2">
                                                        <i class="fas fa-trash-alt text-red-500 h-6 w-6 fa-2x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
<!-- PAGE -->

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
                                <span class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                @else
                                <a href="{{ $tindaklanjut->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                @endif

                                @foreach ($tindaklanjut->links()->elements as $element)
                                @if (is_string($element))
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 ring-1 ring-inset ring-gray-300">{{ $element }}</span>
                                @elseif (is_array($element))
                                    @foreach ($element as $page => $url)
                                    @if ($page == $tindaklanjut->currentPage())
                                        <span class="relative inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">{{ $page }}</a>
                                    @endif
                                    @endforeach
                                @endif
                                @endforeach

                                @if ($tindaklanjut->hasMorePages())
                                <a href="{{ $tindaklanjut->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                @else
                                <span class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
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
    </div></x-app-layout>
