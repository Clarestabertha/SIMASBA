<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User; 

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Deactivate a user's account.
     */
    public function deactivate(Request $request, $id): RedirectResponse
{
    // Cari pengguna berdasarkan ID
    $userToDeactivate = User::findOrFail($id);

    // Cek apakah yang sedang login adalah manajer
    if ($request->user()->is_manager) {
        // Manajer bisa langsung menonaktifkan akun pengguna
        $userToDeactivate->update([
            'persetujuan' => 'deactivated', // Menandai akun sebagai dinonaktifkan
        ]);

        // Redirect pengguna kembali ke halaman profil mereka dengan notifikasi
        return Redirect::route('permintaan_active')->with('status', 'Akun pengguna telah dinonaktifkan.');
    } else {
        // Validasi password pengguna yang ingin menonaktifkan akun
        $request->validateWithBag('userDeactivation', [
            'password' => ['required', 'current_password'],
        ]);

        // Update kolom persetujuan untuk menandai permintaan
        $request->user()->update([
            'persetujuan' => 'deactivation_pending',
        ]);

        // Logout pengguna
        Auth::logout();

        // Redirect pengguna ke halaman awal dengan notifikasi
        return Redirect::to('/')->with('status', 'Permintaan nonaktifkan akun telah diajukan dan menunggu persetujuan.');
    }
}
/**
 * Reactivate a user's account.
 */
public function active(Request $request, $id): RedirectResponse
{
    // Cari pengguna berdasarkan ID
    $userToReactivate = User::findOrFail($id);

    // Cek apakah yang sedang login adalah manajer
    if ($request->user()->is_manager) {
        // Manajer bisa langsung mengaktifkan kembali akun pengguna
        $userToReactivate->update([
            'persetujuan' => NULL, // Menandai akun sebagai diaktifkan kembali
        ]);

        // Redirect pengguna kembali ke halaman profil atau daftar pengguna dengan notifikasi
        return Redirect::route('permintaan_active')->with('status', 'Akun pengguna telah diaktifkan kembali.');
    }

    // Jika bukan manajer, kembalikan respons dengan status tidak diizinkan
    return Redirect::route('permintaan_active')->with('error', 'Anda tidak memiliki izin untuk mengaktifkan akun.');
}


}
