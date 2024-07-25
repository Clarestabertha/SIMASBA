<x-app-layout>
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
                <div class="">
                    <span class="h-full absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path d="M10 2a8 8 0 015.293 13.707L22 21.414 20.586 23l-6.707-6.707A8 8 0 1110 2zm0 2a6 6 0 100 12A6 6 0 0010 4z"></path>
                        </svg>
                    </span>
                    <input placeholder="Search" class="appearance-none rounded-lg border border-gray-400 block pl-10 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"/>
                </div>
            </div>
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-ketiga text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-ketiga text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-ketiga text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Registrasi
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-ketiga text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Disetujui
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    John Doe
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">john.doe@example.com</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">01/01/2021</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                        <button class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    </td>
                                </tr>
                                <!-- Tambahkan baris tambahan di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
