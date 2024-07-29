<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Kerusakan;

class KerusakanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query dengan kondisi pencarian
        $kerusakan = Kerusakan::query()
            ->where(function($query) use ($search) {
                $query->where('nama_pelapor', 'LIKE', "%{$search}%")
                      ->orWhere('tanggal', 'LIKE', "%{$search}%")
                      ->orWhere('sumber_laporan', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%");
            })
            ->paginate(10); // Gunakan paginate() langsung setelah query builder

        return view('manajer.kerusakan', compact('kerusakan'));
    }
    public function show ($id_kerusakan){
            $kerusakan = Kerusakan::findOrFail($id_kerusakan);
            return view('manajer.kerusakan_show', compact('kerusakan'));
    }
    public function destroy($id_kerusakan){
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);
        $kerusakan->delete();
        return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil dihapus');
    }

}
