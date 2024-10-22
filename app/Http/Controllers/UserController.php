<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', ''); // Default ke string kosong jika tidak ada input

    $activePage = $request->input('active_page', 1);
    $inactivePage = $request->input('inactive_page', 1);

    // Query untuk mendapatkan pengguna aktif
    $activeUsers = User::where(function($query) {
        $query->where('persetujuan', NULL)
              ->orWhere('persetujuan', 'deactivation_pending');
    })
                ->where('role', '!=', 'manajer')
        ->when($search, function($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        })
        ->orderByRaw("CASE
            WHEN persetujuan IS NULL THEN 1
            WHEN persetujuan = 'approved' THEN 2
            WHEN persetujuan = 'rejected' THEN 3
        END")
        ->paginate(10, ['*'], 'active_page', $activePage);

    // Query untuk mendapatkan pengguna tidak aktif
    $inactiveUsers = User::where('persetujuan', 'deactivated')
        ->when($search, function($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        })
        ->paginate(10, ['*'], 'inactive_page', $inactivePage);

    if ($request->ajax()) {
        $permintaanactive = User::whereNull('persetujuan')->count();
        $asmen = User::where('role', 'asisten_manajer')
                     ->whereNotNull('persetujuan')
                     ->count();
        $pekerjalapangan = User::where('role', 'pekerja_lapangan')
                              ->whereNotNull('persetujuan')
                              ->count();

        return response()->json([
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'permintaanactive' => $permintaanactive,
            'asmen' => $asmen,
            'pekerjalapangan' => $pekerjalapangan,
        ]);
    }

    $permintaanactive = User::where('persetujuan', 'deactivated')->count();
    $asmen = User::where('role', 'asisten_manajer')
                 ->whereNull('persetujuan')
                 ->count();
    $pekerjalapangan = User::where('role', 'pekerja_lapangan')
                          ->whereNull('persetujuan')
                          ->count();

    return view('manajer.permintaan_active', compact('activeUsers', 'inactiveUsers', 'permintaanactive', 'asmen', 'pekerjalapangan'));
}



    public function approve(User $user)
    {
        $user->update(['persetujuan' => 'deactivated']);
        return response()->json(['status' => 'approved']);
    }

    public function reject(User $user)
    {
        $user->update(['persetujuan' => null]);
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

    return redirect()->route('manajer.permintaan_active') // Ubah sesuai dengan rute Anda
                     ->with('success', 'Akun berhasil dibuat.');
}
   
public function checkEmail(Request $request)
    {
        // Validasi input email
        $request->validate(['email' => 'required|string|email']);

        $email = $request->input('email');
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }
}
