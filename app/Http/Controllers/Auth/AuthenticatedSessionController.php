<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $credentials = $request->only('email', 'password');
    $user = \App\Models\User::where('email', $credentials['email'])->first();

    if (!$user || $user->persetujuan !== 'approved') {
        // Jika pengguna belum disetujui, tampilkan pesan
        return redirect()->route('welcome')->with('status', 'Permintaan Registrasimu sedang di Proses');
    }

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Arahkan pengguna berdasarkan peran mereka
        switch ($user->role) {
            case 'pekerja_lapangan':
                return redirect()->route('homepage.pekerja');
            case 'asisten_manajer':
                return redirect()->route('homepage.asisten_manajer');
            case 'manajer':
                return redirect()->route('dashboard');
        }
    }

    return redirect()->back()->withErrors([
        'password' => 'Password yang anda masukkan salah.',
    ]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
