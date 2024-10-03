<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    // Query dengan kondisi pencarian dan urutan
    $users = User::query()
        ->where(function($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        })
        ->orderByRaw("CASE
            WHEN persetujuan IS NULL THEN 1
            WHEN persetujuan = 'approved' THEN 2
            WHEN persetujuan = 'rejected' THEN 3
        END")
        ->paginate(10);

    if ($request->ajax()) {
        $permintaanregis = User::whereNull('persetujuan')->count();
        $asmen = User::where('role', 'asisten_manajer')
                     ->whereNotNull('persetujuan')  // Hanya yang sudah disetujui atau ditolak
                     ->count();
        $pekerjalapangan = User::where('role', 'pekerja_lapangan')
                              ->whereNotNull('persetujuan')  // Hanya yang sudah disetujui atau ditolak
                              ->count();

        return response()->json([
            'users' => $users,
            'permintaanregis' => $permintaanregis,
            'asmen' => $asmen,
            'pekerjalapangan' => $pekerjalapangan,
        ]);
    }

    $permintaanregis = User::whereNull('persetujuan')->count();
    $asmen = User::where('role', 'asisten_manajer')
                 ->whereNotNull('persetujuan')  // Hanya yang sudah disetujui atau ditolak
                 ->count();
    $pekerjalapangan = User::where('role', 'pekerja_lapangan')
                          ->whereNotNull('persetujuan')  // Hanya yang sudah disetujui atau ditolak
                          ->count();

    return view('manajer.permintaan_regis', compact('users', 'permintaanregis', 'asmen', 'pekerjalapangan'));
}


    public function approve(User $user)
    {
        $user->update(['persetujuan' => 'approved']);
        return response()->json(['status' => 'approved']);
    }

    public function reject(User $user)
    {
        $user->update(['persetujuan' => 'rejected']);
        return response()->json(['status' => 'rejected']);
    }

 public function create()
{
    // Menampilkan halaman form untuk membuat akun baru
    return view('manajer.tambahakun'); // Sesuaikan dengan nama view Anda
}

public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|in:asisten_manajer,pekerja_lapangan', // Sesuaikan dengan role yang ada
    ]);

    // Membuat akun baru
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']), // Enkripsi password
        'role' => $validatedData['role'],
        'persetujuan' => null, // Status persetujuan awal
    ]);

    return redirect()->route('manajer.permintaan_regis') // Ubah sesuai dengan rute Anda
                     ->with('success', 'Akun berhasil dibuat.');
}
   

}
