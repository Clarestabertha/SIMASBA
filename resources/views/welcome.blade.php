<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMASBA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Load Vite generated CSS -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('storage/img/bg welcome page.png'); /* Gambar latar belakang */
            background-size: cover; /* Sesuaikan ukuran gambar */
            background-repeat: no-repeat; /* Agar gambar tidak berulang */
            background-position: center; /* Pusatkan gambar */      
        }
    </style>
</head>
<body class="relative flex items-center justify-center min-h-screen text-center">
    <img src="{{ asset('/storage/img/logo kai.png') }}" class="absolute top-8 left-8 w-20" alt="Logo KAI">
    <div class="flex flex-col sm:flex-row items-center justify-center p-4 sm:p-8 rounded-lg">
        <img src="{{ asset('/storage/img/konten welcome.png') }}" class="w-full sm:w-1/2 lg:w-1/2 max-w-3xl h-auto mb-4 sm:mb-0 sm:mr-8" alt="Konten Welcome">
        <div class="flex flex-col items-center sm:items-start text-center sm:text-left">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-primary mb-4">
                Sistem Informasi Manajemen Stasiun dan Bangunan Dinas DAOP V (SIMASBA)
            </h1>
            <div class="actions space-y-2">
                @if (Route::has('login'))
                    @auth
                        @php
                            $role = Auth::user()->role;
                            $dashboardRoute = '';

                            if ($role === 'pekerja_lapangan') {
                                $dashboardRoute = route('homepage.pekerja');
                            } elseif ($role === 'asisten_manajer') {
                                $dashboardRoute = route('homepage.asisten_manajer');
                            } elseif ($role === 'manajer') {
                                $dashboardRoute = route('dashboard');
                            }
                        @endphp

                        <a href="{{ $dashboardRoute }}" class="inline-block px-6 py-2 bg-secondary text-white rounded-full transition duration-300 hover:bg-red-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-secondary text-white rounded-full transition duration-300 hover:bg-red-700">
                            Log in
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
    @if (session('status'))
    <script>
        alert('{{ session('status') }}');
    </script>
@endif

</body>
</html>
