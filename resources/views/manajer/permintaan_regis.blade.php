<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Permintaan Registrasi Akun
                </h2>
            </div>
            
            <div class="mt-16 flex space-x-14 items-center justify-center">
                <div class="w-60 h-24 gradient-card-1 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center">
                    <div class="flex flex-col items-center text-center text-white p-4">
                        <h3 class="text-4xl font-semibold mb-2">{{$permintaanregis}}</h3>
                        <p>Permintaan Registrasi</p>
                    </div>      
                </div>
                <div class="w-60 h-24 gradient-card-2 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center">
                    <div class="flex flex-col items-center text-center text-white p-4">
                        <h3 class="text-4xl font-semibold mb-2">{{$asmen}}</h3>
                        <p>Akun Asisten Manajer</p>
                    </div>
                </div>
                <div class="w-60 h-24 gradient-card-3 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center">
                    <div class="flex flex-col items-center text-center text-white p-4">
                        <h3 class="text-4xl font-semibold mb-2">{{$pekerjalapangan}}</h3>
                        <p>Akun Pekerja Lapangan</p>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center">
                <div class="w-full max-w-4xl px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="my-2 flex justify-between mt-20">
                        <a href="{{ route('user.insert') }}" class="bg-primary text-white px-4 py-2 rounded-full hover:bg-secondary transition duration-200 flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Akun
                        </a>
                        <div class="relative w-50 flex items-center">
                            <form method="GET" action="{{ route('user.index') }}" class="flex items-center">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-black ml-1">
                                        <path d="M10 2a8 8 0 015.293 13.707L22 21.414 20.586 23l-6.707-6.707A8 8 0 1110 2zm0 2a6 6 0 100 12A6 6 0 0010 4z"></path>
                                    </svg>
                                </span>
                                <input name="search" placeholder="Cari Nama atau Email" class="appearance-none rounded-full border-2 border-black block pl-10 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-black focus:bg-white focus:placeholder-primary focus:text-gray-700 focus:outline-none" value="{{ Request::get('search') }}" />
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
                                        Email
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Tanggal Registrasi
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Role
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Disetujui
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="user-table-body">
                            @foreach($users as $user)
                            <tr class="{{ $user->persetujuan === 'approved' ? 'bg-abu' : ($user->persetujuan === 'rejected' ? 'bg-abu' : 'bg-white') }}">
                                <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                    <p>{{ $user->name }}</p>
                                </td>
                                <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                                </td>
                                <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->created_at }}</p>
                                </td>
                                <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->role }}</p>
                                </td>
                                <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                    @if($user->persetujuan === 'approved')
                                        <span class="text-green-500">Disetujui</span>
                                    @elseif($user->persetujuan === 'rejected')
                                        <span class="text-red-500">Tidak Disetujui</span>
                                    @else
                                        <div class="flex justify-center space-x-2">
                                            <button onclick="updateStatus('{{ route('user.approve', $user->id) }}', this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button onclick="updateStatus('{{ route('user.reject', $user->id) }}', this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 101.414 1.414L10 11.414l2.293 2.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
  <div class="flex flex-1 justify-between sm:hidden">
    @if ($users->onFirstPage())
      <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 cursor-not-allowed">Previous</span>
    @else
      <a href="{{ $users->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
    @endif

    @if ($users->hasMorePages())
      <a href="{{ $users->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
    @else
      <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 cursor-not-allowed">Next</span>
    @endif
  </div>

  <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
    <div>
      <p class="text-sm text-gray-700">
        Showing
        <span class="font-medium">{{ $users->firstItem() }}</span>
        to
        <span class="font-medium">{{ $users->lastItem() }}</span>
        of
        <span class="font-medium">{{ $users->total() }}</span>
        results
      </p>
    </div>
    <div>
      <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        @if ($users->onFirstPage())
          <span class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 cursor-not-allowed">
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
          </span>
        @else
          <a href="{{ $users->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
          </a>
        @endif

        @foreach ($users->links()->elements as $element)
          @if (is_string($element))
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 ring-1 ring-inset ring-gray-300">{{ $element }}</span>
          @elseif (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $users->currentPage())
                <span class="relative inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300">{{ $page }}</span>
              @else
                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">{{ $page }}</a>
              @endif
            @endforeach
          @endif
        @endforeach

        @if ($users->hasMorePages())
          <a href="{{ $users->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
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
    </div>

    <script>
    function updateStatus(url, button) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            const row = button.closest('tr');
            const statusCell = row.querySelector('td:last-child');

            // Update the status cell based on the response
            if (data.status === 'approved') {
                row.classList.add('bg-abu');
                row.classList.remove('bg-white');
                statusCell.innerHTML = '<span class="text-green-500">Disetujui</span>';
            } else if (data.status === 'rejected') {
                row.classList.add('bg-abu');
                row.classList.remove('bg-white');
                statusCell.innerHTML = '<span class="text-red-500">Tidak Disetujui</span>';
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
</x-app-layout>
