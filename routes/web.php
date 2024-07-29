<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\TindaklanjutController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PekerjaKerusakanController;
use App\Http\Controllers\PekerjaTindakLanjutController;
use App\Http\Controllers\AsistenManajerController;
use App\Http\Controllers\AsmenKerusakanController;
use App\Http\Controllers\AsmenTindakLanjutController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'grafikDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/permintaanregis', [UserController::class, 'index'])->name('permintaan_regis');
Route::get('/users', [UserController::class, 'index'])->name('user.index');

Route::post('/user/approve/{user}', [UserController::class, 'approve'])->name('user.approve');
Route::post('/user/reject/{user}', [UserController::class, 'reject'])->name('user.reject');

Route::get('/kerusakan_manajer', [KerusakanController::class, 'index'])->name('kerusakan');
Route::get('/search_kerusakan', [KerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'show'])->name('kerusakan.show');
Route::delete('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'destroy'])->name('kerusakan.destroy');

Route::get('/tindak_lanjut_manajer', [TindaklanjutController::class, 'index'])->name('tindaklanjut');
Route::get('/search_tl', [TindaklanjutController::class, 'index'])->name('tindaklanjut.index');
Route::get('/tindaklanjut/{id_tl}', [TindaklanjutController::class, 'show'])->name('tindaklanjut.show');
Route::delete('/tindaklanjut/{id_tl}', [TindaklanjutController::class, 'destroy'])->name('tindaklanjut.destroy');

Route::get('/homepage/pekerja', [PekerjaController::class, 'index'])->name('homepage.pekerja');
Route::get('/kerusakan', [PekerjaKerusakanController::class, 'index'])->name('kerusakan.pekerja');
Route::get('/search_kerusakan', [PekerjaKerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/tindaklanjut', [PekerjaTindakLanjutController::class, 'index'])->name('tindaklanjut.pekerja');
Route::get('/search_tindaklanjut', [PekerjaTindakLanjutController::class, 'index'])->name('tindaklanjut.index');
Route::get('/panduan', [PekerjaController::class, 'panduan'])->name('panduan');


Route::get('/homepage/asisten-manajer', [AsistenManajerController::class, 'index'])->name('homepage.asisten_manajer');
Route::get('/kerusakan_asmen', [AsmenKerusakanController::class, 'index'])->name('kerusakan.asisten_manajer');
Route::get('/search_kerusakan', [AsmenKerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/tindaklanjut_asmen', [AsmenTindakLanjutController::class, 'index'])->name('tindaklanjut.asisten_manajer');
Route::get('/search_tindaklanjut', [AsmenTindakLanjutController::class, 'index'])->name('tindaklanjut.index');

require __DIR__.'/auth.php';
