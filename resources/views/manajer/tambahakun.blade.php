<x-app-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text mb-6">
                    Tambah Akun
                </h2>
            </div>
            <div class="flex justify-center">
                <div class="w-2/3 px-4 sm:px-8 py-4 overflow-x-auto">
                    <!-- Formulir Pendaftaran -->
                    <form method="POST" action="{{ route('user.store') }}" class="bg-gray-100 shadow-lg rounded pt-6 pb-6 px-12" id="addAccountForm">
                        @csrf

                        <!-- Nama -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full border p-2 rounded" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- Alamat Email -->
                        <div class="mb-4">
                            <x-input-label for="email" :value="('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full border p-2 rounded" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <x-input-label for="role" :value="('Role')"/>
                            <select id="role" name="role" class="block mt-1 w-full p-3 rounded-full border border-black">
                                <option value="" disabled selected>Pilih Role yang sesuai</option>
                                <option value="asisten_manajer" {{ old('role') === 'asisten_manajer' ? 'selected' : '' }}>Asisten Manajer</option>
                                <option value="pekerja_lapangan" {{ old('role') === 'pekerja_lapangan' ? 'selected' : '' }}>Pekerja Lapangan</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-1" />
                        </div>

                        <!-- Kata Sandi -->
                        <div class="mb-4">
                            <x-input-label for="password" :value="('Kata Sandi')" />
                            <x-text-input id="password" class="block mt-1 w-full border p-2 rounded" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <!-- Konfirmasi Kata Sandi -->
                        <div class="mb-4">
                            <x-input-label for="password_confirmation" :value="('Konfirmasi Kata Sandi')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full border p-2 rounded" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div class="ml-auto">
                                <x-primary-button>
                                    {{ __('Kirim') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addAccountForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form secara langsung
            
            const emailInput = document.getElementById('email');
            const email = emailInput.value;
            const roleSelect = document.getElementById('role');
            const selectedRole = roleSelect.value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            // Cek apakah role yang dipilih adalah "Pilih Role yang sesuai"
            if (selectedRole === "") {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Silakan pilih role Asisten Manajer atau Pekerja Lapangan.',
                    icon: 'warning',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'bg-blue-500 text-white'
                    }
                });
                return; // Jangan lanjutkan pengiriman form
            }

            // Cek apakah kata sandi kurang dari 8 karakter
            if (password.length < 8) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Kata sandi minimal 8 karakter.',
                    icon: 'warning',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'bg-blue-500 text-white'
                    }
                });
                return; // Jangan lanjutkan pengiriman form
            }

            // Cek apakah kata sandi dan konfirmasi kata sandi sesuai
            if (password !== passwordConfirmation) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Konfirmasi kata sandi tidak sesuai dengan kata sandi.',
                    icon: 'warning',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'bg-blue-500 text-white'
                    }
                });
                return; // Jangan lanjutkan pengiriman form
            }

            // Cek apakah email sudah ada
            fetch("{{ route('user.checkEmail') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Email sudah terdaftar. Silakan gunakan email lain.',
                        icon: 'warning',
                        confirmButtonText: 'Tutup',
                        customClass: {
                            confirmButton: 'bg-blue-500 text-white'
                        }
                    });
                } else {
                    // Kirim form jika email tidak ada
                    const formData = new FormData(this);
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Menampilkan popup centang bergerak
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Akun berhasil ditambahkan.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                                willClose: () => {
                                    // Mengarahkan kembali ke halaman sebelumnya
                                    window.history.back();
                                }
                            });
                        } else {
                            // Menangani kesalahan
                            return response.json().then(error => {
                                Swal.fire({
                                    title: 'Kesalahan!',
                                    text: error.message || 'Terjadi kesalahan saat menambahkan akun.',
                                    icon: 'error'
                                });
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Kesalahan!',
                            text: 'Terjadi kesalahan saat menambahkan akun.',
                            icon: 'error'
                        });
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Kesalahan!',
                    text: 'Terjadi kesalahan saat memeriksa email.',
                    icon: 'error'
                });
            });
        });
    </script>
</x-app-layout>