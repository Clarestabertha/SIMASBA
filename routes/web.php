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

Route::get('/akun', [UserController::class, 'index'])->name('permintaan_active');
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/tambah_akun', [UserController::class, 'create'])->name('user.insert');
Route::get('/tambah_akun/store', [UserController::class, 'store'])->name('user.store');
Route::post('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');



Route::post('/user/approve/{user}', [UserController::class, 'approve'])->name('user.approve');
Route::post('/user/reject/{user}', [UserController::class, 'reject'])->name('user.reject');

Route::get('/kerusakan_manajer', [KerusakanController::class, 'index'])->name('kerusakan');
Route::get('/search_kerusakan', [KerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'show'])->name('kerusakan.show');
Route::delete('/kerusakan/{id_kerusakan}', [KerusakanController::class, 'destroy'])->name('kerusakan.destroy');
// Route untuk persetujuan oleh asisten manajer
Route::put('/kerusakan/{id_kerusakan}/approve-asisten', [KerusakanController::class, 'approveByAsisten'])->name('kerusakan.approve_asisten');
Route::put('/kerusakan/{id_kerusakan}/reject-asisten', [KerusakanController::class, 'rejectByAsisten'])->name('kerusakan.reject_asisten');

// Route untuk persetujuan oleh manajer
Route::put('/kerusakan/{id_kerusakan}/approve-manajer', [KerusakanController::class, 'approveByManajer'])->name('kerusakan.approve_manajer');
Route::put('/kerusakan/{id_kerusakan}/reject-manajer', [KerusakanController::class, 'rejectByManajer'])->name('kerusakan.reject_manajer');


Route::get('/tindak_lanjut_manajer', [TindaklanjutController::class, 'index'])->name('tindaklanjut');
Route::get('/search_tl', [TindaklanjutController::class, 'index'])->name('tindaklanjut.index');
Route::get('/tindaklanjut/{id_tl}', [TindaklanjutController::class, 'show'])->name('tindaklanjut.show');
Route::delete('/tindaklanjut/{id_tl}', [TindaklanjutController::class, 'destroy'])->name('tindaklanjut.destroy');

Route::put('/tindaklanjut/{id_tl}/approve-asisten', [TindaklanjutController::class, 'approveByAsisten'])->name('tindaklanjut.approve_asisten');
Route::put('/tindaklanjut/{id_tl}/reject-asisten', [TindaklanjutController::class, 'rejectByAsisten'])->name('tindaklanjut.reject_asisten');

// Route untuk persetujuan oleh manajer
Route::put('/tindaklanjut/{id_tl}/approve-manajer', [TindaklanjutController::class, 'approveByManajer'])->name('tindaklanjut.approve_manajer');
Route::put('/tindaklanjut/{id_tl}/reject-manajer', [TindaklanjutController::class, 'rejectByManajer'])->name('tindaklanjut.reject_manajer');


Route::get('/homepage/pekerja', [PekerjaController::class, 'index'])->name('homepage.pekerja');
Route::get('/kerusakan-pekerja', [PekerjaKerusakanController::class, 'index'])->name('kerusakan.pekerja');
Route::get('/search_kerusakan', [PekerjaKerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/input_kerusakan', [PekerjaKerusakanController::class, 'insert'])->name('kerusakan.insert');
Route::post('/kerusakan/store', [PekerjaKerusakanController::class, 'store'])->name('kerusakan.store');
Route::get('/kerusakan-pekerja/show/{id_kerusakan}', [PekerjaKerusakanController::class, 'show'])->name('kerusakan.pekerja.show');
Route::delete('/kerusakan-pekerja/{id_kerusakan}', [PekerjaKerusakanController::class, 'destroy'])->name('kerusakan.pekerja.destroy');
Route::get('/tindaklanjut', [PekerjaTindakLanjutController::class, 'index'])->name('tindaklanjut.pekerja');
Route::get('/search_tindaklanjut', [PekerjaTindakLanjutController::class, 'index'])->name('tindaklanjut.index');
Route::get('/input_tindaklanjut', [PekerjaTindakLanjutController::class, 'insert'])->name('tindaklanjut.insert');
Route::get('/input_tindaklanjut/{id_kerusakan}', [PekerjaTindakLanjutController::class, 'insert'])->name('tindaklanjut.input');
Route::post('/tindaklanjut/store', [PekerjaTindakLanjutController::class, 'store'])->name('tindaklanjut.store');
Route::get('/tindaklanjut-pekerja/show/{id_tl}', [PekerjaTindakLanjutController::class, 'show'])->name('tindaklanjut.pekerja.show');
Route::delete('/tindaklanjut-pekerja/{id_tl}', [PekerjaTindakLanjutController::class, 'destroy'])->name('tindaklanjut.pekerja.destroy');
Route::get('/panduan', [PekerjaController::class, 'panduan'])->name('panduan');
Route::post('/update-selesai', [PekerjaController::class, 'updateSelesai'])->name('update.selesai');


Route::get('/homepage/asisten-manajer', [AsistenManajerController::class, 'index'])->name('homepage.asisten_manajer');
Route::get('/kerusakan_asmen', [AsmenKerusakanController::class, 'index'])->name('kerusakan.asisten_manajer');
Route::get('/search_kerusakan', [AsmenKerusakanController::class, 'index'])->name('kerusakan.index');
Route::get('/kerusakan-asmen/{id_kerusakan}', [AsmenKerusakanController::class, 'show'])->name('kerusakan.asmen.show');
Route::get('/tindaklanjut_asmen', [AsmenTindakLanjutController::class, 'index'])->name('tindaklanjut.asisten_manajer');
Route::get('/search_tindaklanjut', [AsmenTindakLanjutController::class, 'index'])->name('tindaklanjut.index');
Route::get('/tindaklanjut-asmen/{id_tl}', [AsmenTindakLanjutController::class, 'show'])->name('tindaklanjut.asmen.show');


require __DIR__.'/auth.php';
