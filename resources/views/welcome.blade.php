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
    <!-- Styles -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('storage/img/bg welcome page.png'); /* Gambar latar belakang */
            background-size: cover; /* Sesuaikan ukuran gambar */
            background-repeat: no-repeat; /* Agar gambar tidak berulang */
            background-position: center; /* Pusatkan gambar */      
        }

        .konten {
            max-width: 50%;
            height: auto;
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 30px; /* Mengubah dari right ke left */
        }

        .judul {
            font-size: 40px;
            color: #2D2A6C;
            margin-bottom: 20px;
        }

        .kontainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Mengisi tinggi layar */
            text-align: center;
        }

        .kontainer .konten {
            max-width: 50%;
            height: auto;
            margin-right: 20px;
        }

        .kontainer .judul {
            max-width: 80%;
            text-align: left;
            margin-left:50px;
        }

        .kontainer .actions {
            margin-top: 20px;
        }

        .actions a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FF2D20;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            transition: background-color 0.3s;
            float : left;
            margin-left:50px;

        }

        .actions a:hover {
            background-color: #d0241c;
        }
    </style>
</head>
<body>
    <img src="{{ asset('/storage/img/logo kai.png') }}" class="logo" alt="Logo KAI">

    <div class="kontainer">
        <img src="{{ asset('/storage/img/konten welcome.jpg') }}" class="konten" alt="Konten Welcome">
        <div class="text">
            <h1 class="judul">Sistem Informasi Manajemen Stasiun dan Bangunan Dinas DAOP V (SIMASBA)</h1>
            <div class="actions">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>

</body>
</html>
