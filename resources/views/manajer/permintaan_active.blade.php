<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Akun Yang Terdaftar
                </h2>
            </div>
            
            <div class="mt-16 flex space-x-14 items-center justify-center">
                <div class="w-60 h-24 gradient-card-1 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center">
                    <div class="flex flex-col items-center text-center text-white p-4">
                        <h3 class="text-4xl font-semibold mb-2">{{$permintaanactive}}</h3>
                        <p>Akun Non Aktif</p>
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
                        <table id="active-users-table" class="min-w-full leading-normal">
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
                                        Status Akun
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Kelola
                                    </th> 
                                </tr>
                            </thead>
                            <tbody id="active-user-table-body">
                            @foreach($activeUsers as $user)
                                        <tr class="{{ $user->persetujuan === 'rejected' ? 'bg-abu' : 'bg-white' }}">
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
                                                @if($user->persetujuan === NULL)
                                                    <span class="text-green-500">Aktif</span>
                                                @else
                                                    <div class="flex justify-center space-x-2">
                                                        <button onclick="updateStatus('{{ route('user.approve', $user->id) }}', this)" style="background: none; border: none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                        <button onclick="updateStatus('{{ route('user.reject', $user->id) }}', this)" style="background: none; border: none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 101.414 1.414L10 11.414l2.293 2.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                                <x-secondary-button
                                                    x-data=""
                                                    x-on:click.prevent="if (confirm('Apakah Anda yakin ingin menonaktifkan akun ini?')) { document.getElementById('deactivate-form-{{ $user->id }}').submit(); }"
                                                    style="background: none; border: none;"
                                                >
                                                    <i class="fas fa-user-slash text-red-500 h-6 w-6 fa-2x"></i>
                                                </x-secondary-button>

                                                <form id="deactivate-form-{{ $user->id }}" method="POST" action="{{ route('user.deactivate', $user->id) }}" class="hidden">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="POST">
                                                </form>
                                            </td>
                                        </tr>
                                @endforeach
                          </tbody>
                        </table>
                    </div>
                    <div class="py-4">
    {{ $activeUsers->appends(['inactive_page' => $inactiveUsers->currentPage()])->links() }} <!-- Pagination untuk Akun Aktif -->
</div>
<!--TABEL NONAKTIF-->
<div class="inline-block min-w-full shadow rounded-lg overflow-hidden mt-5">
<h2 class="text-2xl font-bold leading-tight text-center gradient-text mb-6">
    Akun Non Aktif
</h2>
                        <table id="inactive-users-table" class="min-w-full leading-normal">
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
                                        Status Akun
                                    </th>
                                    <th class="px-5 py-3 border border-abu bg-ketiga text-center text-base font-semibold text-black">
                                        Kelola
                                    </th> 
                                </tr>
                            </thead>
                            <tbody id="inactive-user-table-body">
                            @foreach($inactiveUsers as $user)
                                    @if ($user->persetujuan === 'deactivated')
                                        <tr class="bg-abu">
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
                                            <span class="text-red-500">Non Aktif</span>
                                            </td>
                                            <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                                        <x-secondary-button
                                            x-data=""
                                            x-on:click.prevent="if (confirm('Apakah Anda yakin ingin mengaktifkan kembali akun ini?')) { document.getElementById('deactivate-form-{{ $user->id }}').submit(); }"
                                            style="background: none; border: none;"
                                        >
                                            <i class="fas fa-user-check text-green-500 h-6 w-6 fa-2x"></i>
                                        </x-secondary-button>

                                        <form id="deactivate-form-{{ $user->id }}" method="POST" action="{{ route('user.active', $user->id) }}" class="hidden">
                                            @csrf
                                            <input type="hidden" name="_method" value="POST">
                                        </form>
                                    </td>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="py-4">
    {{ $inactiveUsers->appends(['active_page' => $activeUsers->currentPage()])->links() }} <!-- Pagination untuk Akun Non Aktif -->
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
        if (data.status === 'deactivated') {
            row.classList.add('bg-abu');
            row.classList.remove('bg-white');
            statusCell.innerHTML = '<span class="text-red-500">Non Aktif</span>';
        } else if (data.status === 'rejected') {
            statusCell.innerHTML = '<span class="text-green-500">Aktif</span>';
        }

        // Reload the page to reflect changes
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}
    
</script>
</x-app-layout>