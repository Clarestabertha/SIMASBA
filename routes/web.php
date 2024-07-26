<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\KerusakanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/kerusakan', [KerusakanController::class, 'index'])->name('kerusakan');
Route::get('/search_kerusakan', [KerusakanController::class, 'index'])->name('kerusakan.index');


require __DIR__.'/auth.php';
