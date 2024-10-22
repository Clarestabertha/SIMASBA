<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Tindaklanjut;

class AsmenTindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $disetujuiPage = $request->input('disetujui_page', 1);
        $ditolakPage = $request->input('ditolak_page', 1);

        $disetujui = Tindaklanjut::query()
            ->whereIn('status', ['sedang diproses', 'disetujui', 'disetujui_asisten'])
            ->where(function($query) use ($search) {
                $query->where('nama_pelapor', 'LIKE', "%{$search}%")
                      ->orWhere('tanggal', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%")
                      ->orWhere('personel', 'LIKE', "%{$search}%")
                      ->orWhere('sumber', 'LIKE', "%{$search}%");
            })
            ->orderByRaw("CASE 
            WHEN status = 'sedang diproses' THEN 1 
            WHEN status = 'disetujui_asisten' THEN 2 
            ELSE 3 
            END")
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'disetujui_page', $disetujuiPage);
            
        $ditolak = Tindaklanjut::query()
            ->whereIn('status', ['ditolak','ditolak_asisten'])
            ->where(function($query) use ($search) {
                $query->where('nama_pelapor', 'LIKE', "%{$search}%")
                      ->orWhere('tanggal', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%")
                      ->orWhere('personel', 'LIKE', "%{$search}%")
                      ->orWhere('sumber', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'ditolak_page', $ditolakPage);

            return view('asmen.tindaklanjut', compact('disetujui', 'ditolak'));
    }
    public function show($id_tl)
{
    $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
    $tindaklanjut->foto = explode(',', $tindaklanjut->foto);
    return view('manajer.tindaklanjut_show', compact('tindaklanjut'));
}
}
