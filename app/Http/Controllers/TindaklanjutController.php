<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Tindaklanjut;

class TindaklanjutController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query dengan kondisi pencarian
        $tindaklanjut = Tindaklanjut::query()
            ->where(function($query) use ($search) {
                $query->where('nama_pelapor', 'LIKE', "%{$search}%")
                      ->orWhere('tanggal', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%")
                      ->orWhere('personel', 'LIKE', "%{$search}%")
                      ->orWhere('sumber', 'LIKE', "%{$search}%");
            })
            ->paginate(10); // Gunakan paginate() langsung setelah query builder

        return view('manajer.tindaklanjut', compact('tindaklanjut'));
    }
    public function show ($id_tl){
        $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
        return view('manajer.tindaklanjut_show', compact('tindaklanjut'));
}
public function destroy($id_tl){
    $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
    $tindaklanjut->delete();
    return redirect()->route('tindaklanjut.index')->with('success', 'Data kerusakan berhasil dihapus');
}
}
