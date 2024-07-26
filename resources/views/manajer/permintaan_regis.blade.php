<x-app-layout>
    <head>
        <!-- Pastikan meta tag CSRF token ada di dalam elemen <head> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <!-- Judul -->
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Permintaan Registrasi Akun
                </h2>
            </div>
            
            <!-- Kartu (Cards) -->
            <div class="mt-16 flex space-x-14 items-center justify-center">
                <div class="w-60 h-24 gradient-card-1 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center">
                    <div class="flex flex-col items-center text-center text-white p-4">
                        <h3 class="text-4xl font-semibold mb-2">113</h3>
                        <p>Permintaan Registrasi</p>
                    </div>      
                </div>
                <div class="w-60 h-24 gradient-card-2 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center">
                    <div class="flex flex-col items-center text-center text-white p-4">
                        <h3 class="text-4xl font-semibold mb-2">113</h3>
                        <p>Akun Asisten Manajer</p>
                    </div>
                </div>
                <div class="w-60 h-24 gradient-card-3 shadow-lg rounded-3xl overflow-hidden flex items-center justify-center">
                    <div class="flex flex-col items-center text-center text-white p-4">
                        <h3 class="text-4xl font-semibold mb-2">5</h3>
                        <p>Akun Pekerja Lapangan</p>
                    </div>
                </div>
            </div>
            
            <!-- Formulir Pencarian dan Tabel -->
            <div class="flex justify-center">
                <div class="w-full max-w-4xl px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="my-2 flex flex-row-reverse mt-20">
    <div class="relative w-50">
        <form method="GET" action="{{ route('user.index') }}">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-black ml-1">
                    <path d="M10 2a8 8 0 015.293 13.707L22 21.414 20.586 23l-6.707-6.707A8 8 0 1110 2zm0 2a6 6 0 100 12A6 6 0 0010 4z"></path>
                </svg>
            </span>
            <input name="search" placeholder="Cari nama atau email" class="appearance-none rounded-full border-2 border-black block pl-10 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-black focus:bg-white focus:placeholder-primary focus:text-gray-700 focus:outline-none" value="{{ request('search') }}"/>
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
                            <tbody>
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
                                            <!-- Ikon centang berwarna hijau -->
                                            <button onclick="updateStatus('{{ route('user.approve', $user->id) }}', this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <!-- Ikon silang berwarna merah -->
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
                            <!-- Tambahkan baris tambahan di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan skrip JavaScript di sini -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));

        // Urutkan baris berdasarkan status persetujuan
        rows.sort((a, b) => {
            const statusA = a.querySelector('td:last-child').textContent.trim();
            const statusB = b.querySelector('td:last-child').textContent.trim();

            // Urutkan dengan status 'Belum Disetujui' di atas, diikuti 'Disetujui' dan 'Tidak Disetujui'
            if (statusA === 'Belum Disetujui' && statusB !== 'Belum Disetujui') return -1;
            if (statusA !== 'Belum Disetujui' && statusB === 'Belum Disetujui') return 1;
            if (statusA === 'Disetujui' && statusB === 'Tidak Disetujui') return -1;
            if (statusA === 'Tidak Disetujui' && statusB === 'Disetujui') return 1;

            return 0;
        });

        // Tambahkan baris yang sudah diurutkan ke tabel
        const tbody = table.querySelector('tbody');
        rows.forEach(row => tbody.appendChild(row));
    });

    function updateStatus(url, button) {
    if (confirm('Apakah Anda yakin ingin mengubah status pengguna ini?')) {
        fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ _method: 'POST' }) // Jika Anda menggunakan POST di rute
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'approved') {
                const row = button.closest('tr');
                const statusCell = row.querySelector('td:last-child');
                statusCell.innerHTML = '<span class="text-green-500">Disetujui</span>';
                row.classList.replace('bg-white', 'bg-abu');
            } else if (data.status === 'rejected') {
                const row = button.closest('tr');
                const statusCell = row.querySelector('td:last-child');
                statusCell.innerHTML = '<span class="text-red-500">Tidak Disetujui</span>';
                row.classList.replace('bg-white', 'bg-abu');
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan saat memperbarui status.');
        });
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const form = searchInput.closest('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const query = searchInput.value;
        const url = form.action + '?search=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Kosongkan tabel saat ini
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = '';

            // Tambahkan baris baru dari hasil pencarian
            data.users.forEach(user => {
                const row = document.createElement('tr');
                row.className = user.persetujuan === 'approved' ? 'bg-abu' : (user.persetujuan === 'rejected' ? 'bg-abu' : 'bg-white');
                row.innerHTML = `
                    <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                        <p>${user.name}</p>
                    </td>
                    <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                        <p class="text-gray-900 whitespace-no-wrap">${user.email}</p>
                    </td>
                    <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                        <p class="text-gray-900 whitespace-no-wrap">${user.created_at}</p>
                    </td>
                    <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                        <p class="text-gray-900 whitespace-no-wrap">${user.role}</p>
                    </td>
                    <td class="px-5 py-5 border border-gray-200 text-sm text-center">
                        ${user.persetujuan === 'approved' ? '<span class="text-green-500">Disetujui</span>' : user.persetujuan === 'rejected' ? '<span class="text-red-500">Tidak Disetujui</span>' : `
                        <div class="flex justify-center space-x-2">
                            <button onclick="updateStatus('${route('user.approve', user.id)}', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button onclick="updateStatus('${route('user.reject', user.id)}', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 101.414 1.414L10 11.414l2.293 2.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>`}
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
    </script>

</x-app-layout>
