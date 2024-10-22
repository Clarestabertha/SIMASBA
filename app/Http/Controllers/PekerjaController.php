<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Kerusakan;
use Illuminate\Support\Facades\Auth;


class PekerjaController extends Controller
{
    public function index(){
        $user = Auth::user();
        $kerusakan = Kerusakan::where('status', 'disetujui')
                            ->where('selesai_perbaikan', 'belum')
                            ->where('nama_pelapor', $user->name) 
                            ->get();
        return view('pekerja.homepage', compact('kerusakan'));
    }
    public function panduan(){
        return view('pekerja.panduan');
    }
    public function updateSelesai(Request $request)
{
    $kerusakan = Kerusakan::find($request->id_kerusakan);
    if ($kerusakan) {
        $kerusakan->selesai_perbaikan = 'selesai';
        $kerusakan->save();
    }
    return response()->json(['success' => true]);
}

}
