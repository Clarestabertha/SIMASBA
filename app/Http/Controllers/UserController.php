<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Pastikan untuk mengimpor View
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    // Query untuk mengambil pengguna berdasarkan pencarian (case-insensitive)
    $users = User::query()
        ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
        ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%'])
        ->orderByRaw("CASE
            WHEN persetujuan IS NULL THEN 1
            WHEN persetujuan = 'approved' THEN 2
            WHEN persetujuan = 'rejected' THEN 3
        END")
        ->get();

    if ($request->ajax()) {
        return response()->json(['users' => $users]);
    }

    return view('manajer.permintaan_regis', compact('users'));
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
}