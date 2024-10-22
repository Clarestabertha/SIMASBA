<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Kerusakan;

class AsmenKerusakanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $disetujuiPage = $request->input('disetujui_page', 1);
        $ditolakPage = $request->input('ditolak_page', 1);

        $disetujui = Kerusakan::query()
            ->whereIn('status', ['sedang diproses', 'disetujui', 'disetujui_asisten'])
            ->where(function($query) use ($search) {
                $query->Where('tanggal', 'LIKE', "%{$search}%")
                    ->orWhere('nama_pelapor', 'LIKE', "%{$search}%")
                      ->orWhere('sumber_laporan', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%");
            })
            ->orderByRaw("CASE 
                        WHEN status = 'sedang diproses' THEN 1 
                        WHEN status = 'disetujui_asisten' THEN 2 
                        ELSE 3 
                      END")
        ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'disetujui_page', $disetujuiPage);

        $ditolak = Kerusakan::query()
        ->whereIn('status', ['ditolak','ditolak_asisten'])
        ->where(function($query) use ($search) {
                $query->Where('tanggal', 'LIKE', "%{$search}%")
                ->orWhere('nama_pelapor', 'LIKE', "%{$search}%")
                      ->orWhere('sumber_laporan', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'ditolak_page', $ditolakPage);

        return view('asmen.kerusakan', compact('disetujui', 'ditolak'));
    }
    public function show($id)
{
    $kerusakan = Kerusakan::findOrFail($id);
    // Misalkan foto_kerusakan disimpan sebagai string yang dipisahkan oleh koma
    $kerusakan->foto_kerusakan = explode(',', $kerusakan->foto_kerusakan);
    return view('manajer.kerusakan_show', compact('kerusakan'));
}
}
