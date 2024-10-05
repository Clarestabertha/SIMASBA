<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

    public function deactivate(Request $request): RedirectResponse
{
    // Validasi password pengguna yang ingin menonaktifkan akun
    $request->validateWithBag('userDeactivation', [
        'password' => ['required', 'current_password'],
    ]);

    // Dapatkan pengguna yang sedang login
    $user = $request->user();

    // Update kolom persetujuan menjadi 'deactivation_pending' untuk menandai permintaan
    $user->update([
        'persetujuan' => 'deactivation_pending',
    ]);

    // Logout pengguna setelah mengajukan permintaan nonaktif
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect pengguna ke halaman awal dengan notifikasi
    return Redirect::to('/')->with('status', 'Permintaan nonaktifkan akun telah diajukan dan menunggu persetujuan.');
}
    
}
