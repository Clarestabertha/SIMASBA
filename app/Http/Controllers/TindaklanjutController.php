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
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Gunakan paginate() langsung setelah query builder

        return view('manajer.tindaklanjut', compact('tindaklanjut'));
    }
    public function show ($id_tl){
        $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
        $tindaklanjut->foto = explode(',', $tindaklanjut->foto);
        return view('manajer.tindaklanjut_show', compact('tindaklanjut'));
    }
    public function destroy($id_tl){
        $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
        foreach (explode(',', $tindaklanjut->foto) as $fotos) {
            $path = storage_path('app/public/' . $fotos);
            if (file_exists($path)) {
                unlink($path); // Menghapus file dari filesystem
            }
        }
        $tindaklanjut->delete();
        return redirect()->route('tindaklanjut.index')->with('success', 'Data kerusakan berhasil dihapus');
    }
    public function approveByAsisten(Request $request, $id_tl)
{
    $tindaklanjut = Tindaklanjut::findOrFail($id_tl);

    if ($tindaklanjut->status === 'sedang diproses') {
        $tindaklanjut->status = 'disetujui_asisten';
        $tindaklanjut->save();
        return redirect()->route('tindaklanjut.asisten_manajer', $tindaklanjut->id_tl);    }
}


    public function approveByManajer($id_tl)
{
    $tindaklanjut = Tindaklanjut::findOrFail($id_tl);

    if ($tindaklanjut->status === 'disetujui_asisten') {
        // Update status hanya jika status saat ini adalah 'approved_asisten'
        $tindaklanjut->status = 'disetujui';
        $tindaklanjut->save();
        return redirect()->route('tindaklanjut', $tindaklanjut->id_tl);    }
}
    public function rejectByAsisten($id_tl)
    {
        $tindaklanjut = Tindaklanjut::findOrFail($id_tl);

        if ($tindaklanjut->status === 'sedang diproses') {
            $tindaklanjut->status = 'ditolak_asisten';
            $tindaklanjut->save();
            return redirect()->route('tindaklanjut.asisten_manajer', $tindaklanjut->id_tl);    
        }
    }

    public function rejectByManajer($id_tl)
    {
        $tindaklanjut = Tindaklanjut::findOrFail($id_tl);

        if ($tindaklanjut->status === 'ditolak_asisten') {
            $tindaklanjut->status = 'ditolak';
            $tindaklanjut->save();
            return redirect()->route('tindaklanjut', $tindaklanjut->id_tl);    
        }

    }
    }
