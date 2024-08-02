<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Tindaklanjut;
use Illuminate\Support\Facades\Auth;


class PekerjaTindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();

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

        return view('pekerja.tindaklanjut', compact('tindaklanjut'));
    }
    public function insert(): View
    {
        return view('pekerja.tindaklanjut_insert');
    }
    public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'lokasi' => 'required|string',
        'untuk' => 'required|array',
        'deskripsi' => 'required|string',
        'personel' => 'required|string',
        'sumber' => 'required|string',
        'foto' => 'required|array|max:5',
        'foto.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $fotos = [];
    if ($request->hasfile('foto')) {
        foreach ($request->file('foto') as $file) {
            $name = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/tindaklanjut', $name);
            $fotos[] = 'tindaklanjut/' . $name; // Path to store in the database
        }
    }

    // Mengubah array 'untuk' menjadi string
    $untuk = implode(',', $request->untuk);

    $tindaklanjut = new Tindaklanjut([
        'status' => 'sedang diproses',
        'nama_pelapor' => Auth::user()->name,
        'tanggal' => $request->tanggal,
        'lokasi' => $request->lokasi,
        'untuk' => $untuk, // Simpan sebagai string
        'deskripsi' => $request->deskripsi,
        'personel' => $request->personel,
        'sumber' => $request->sumber,
        'foto' => implode(',', $fotos) // Mengubah array foto menjadi string
    ]);

    $tindaklanjut->save();

    return redirect()->route('tindaklanjut.pekerja')->with('success', 'Tindak lanjut berhasil ditambahkan.');
}

    public function destroy($id_tl)
{
    $tindaklanjut = Tindaklanjut::findOrFail($id_tl);

    // Menghapus setiap foto yang terkait
    foreach (explode(',', $tindaklanjut->foto) as $fotos) {
        $path = storage_path('app/public/' . $fotos);
        if (file_exists($path)) {
            unlink($path); // Menghapus file dari filesystem
        }
    }

    // Menghapus data dari database
    $tindaklanjut->delete();

    return redirect()->route('tindaklanjut.pekerja')->with('success', 'Data tindak lanjut berhasil dihapus');
}
public function show($id_tl)
    {
        $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
        $tindaklanjut->foto = explode(',', $tindaklanjut->foto);
        return view('manajer.tindaklanjut_show', compact('tindaklanjut'));
    }
    public function approve(Request $request, $id_tl)
{
    $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
    $role = Auth::user()->role;

    if ($role === 'asisten_manajer' && $tindaklanjut->status === 'sedang diproses') {
        // Asisten Manajer menyetujui
        $tindaklanjut->status = 'disetujui_asisten';
    } elseif ($role === 'manajer' && $tindaklanjut->status === 'disetujui_asisten') {
        // Manajer menyetujui
        $tindaklanjut->status = 'disetujui';
    } else {
        return redirect()->route('tindaklanjut.pekerja')->with('error', 'Laporan tidak dapat disetujui pada status saat ini.');
    }

    $tindaklanjut->save();

    return redirect()->route('tindaklanjut.pekerja')->with('success', 'Tindak Lanjut berhasil disetujui.');
}
    public function reject(Request $request, $id_tl)
    {
        $tindaklanjut = Tindaklanjut::findOrFail($id_tl);
        $role = Auth::user()->role;

        if ($role === 'asisten_manajer' && $tindaklanjut->status === 'sedang diproses') {
            $tindaklanjut->status = 'ditolak_asisten';
        } elseif ($role === 'manajer' && $tindaklanjut->status === 'ditolak_asisten') {
            $tindaklanjut->status = 'ditolak';
        } else {
            return redirect()->route('tindaklanjut.pekerja')->with('error', 'Laporan tidak dapat ditolak pada status saat ini.');
        }

        $tindaklanjut->save();

        return redirect()->route('tindaklanjut.pekerja')->with('success', 'Tindak Lanjut berhasil ditolak.');
    }
}
