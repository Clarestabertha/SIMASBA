<x-app-layout>
    <x-slot name="header">
            <div class="mt-12">
                <h2 class="text-5xl font-bold leading-tight text-center gradient-text">
                    Profil Akun
                </h2>
            </div>
    </x-slot>

    <div class="py-12"  >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex space-x-6 mt-5 justify-center">
            <!-- Selamat Datang Box -->
            <div class="w-1/4 p-4 sm:p-8 bg-primary bg-opacity-15 shadow sm:rounded-2xl max-h-96">
    <div class="flex items-center space-x-4 mt-4">
        <img src="{{ asset('/storage/img/akun.png') }}" class="w-14 h-14">
        <div>
            <h3 class="text-lg text-black">Halo</h3>
            <p class="text-xl font-medium text-black">{{ $user->name }}</p>
        </div>
    </div>
    <ul class="mt-16 space-y-2">
        <li><a href="#card1" class="block px-4 py-2 text-black rounded hover:bg-primary hover:text-white text-lg">Akun Saya</a></li>
        <li><a href="#card2" class="block px-4 py-2 text-black rounded hover:bg-primary hover:text-white text-lg">Perbarui Kata Sandi</a></li>
        <li><a href="#card3" class="block px-4 py-2 text-black rounded hover:bg-primary hover:text-white text-lg">Hapus Akun</a></li>
    </ul>
</div>




            <!-- Forms -->
            <div class="w-80 space-y-6">
                <div id="card1" class="p-4 sm:p-8 bg-primary bg-opacity-15 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div id="card2" class="p-4 sm:p-8 bg-primary bg-opacity-15 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div id="card3" class="p-4 sm:p-8 bg-primary bg-opacity-15 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
