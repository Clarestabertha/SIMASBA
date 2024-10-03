<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Kerusakan;
use Illuminate\Support\Facades\Auth;

class PekerjaKerusakanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();

        $kerusakan = Kerusakan::query()
            ->where('user_id', $user->id)
            ->where(function($query) use ($search) {
                $query->Where('tanggal', 'LIKE', "%{$search}%")
                      ->orWhere('sumber_laporan', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pekerja.kerusakan', compact('kerusakan'));
    }

    public function insert(): View
    {
        return view('pekerja.kerusakan_insert');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'sumber_laporan' => 'required|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'foto_kerusakan' => 'required|array|max:5',
            'foto_kerusakan.*' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $fotos = [];
        if ($request->hasfile('foto_kerusakan')) {
            foreach ($request->file('foto_kerusakan') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/kerusakan', $name);
                $fotos[] = 'kerusakan/' . $name; // Path to store in the database
            }
        }

        $kerusakan = new Kerusakan([
            'user_id' => Auth::user()->id,
            'nama_pelapor' => Auth::user()->name,
            'tanggal' => $request->tanggal,
            'sumber_laporan' => $request->sumber_laporan,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto_kerusakan' => implode(',', $fotos)
        ]);

        $kerusakan->save();

        return redirect()->route('kerusakan.pekerja')->with('success', 'Kerusakan berhasil ditambahkan.');
    }

    public function destroy($id_kerusakan)
{
    $kerusakan = Kerusakan::findOrFail($id_kerusakan);

    // Menghapus setiap foto yang terkait
    foreach (explode(',', $kerusakan->foto_kerusakan) as $foto) {
        $path = storage_path('app/public/' . $foto);
        if (file_exists($path)) {
            unlink($path); // Menghapus file dari filesystem
        }
    }

    // Menghapus data dari database
    $kerusakan->delete();

    return redirect()->route('kerusakan.pekerja')->with('success', 'Data kerusakan berhasil dihapus');
}

    public function show($id)
    {
        $kerusakan = Kerusakan::findOrFail($id);
        $kerusakan->foto_kerusakan = explode(',', $kerusakan->foto_kerusakan);
        return view('manajer.kerusakan_show', compact('kerusakan'));
    }

    public function approve(Request $request, $id_kerusakan)
{
    $kerusakan = Kerusakan::findOrFail($id_kerusakan);
    $role = Auth::user()->role;

    if ($role === 'asisten_manajer' && $kerusakan->status === 'sedang diproses') {
        // Asisten Manajer menyetujui
        $kerusakan->status = 'disetujui_asisten';
    } elseif ($role === 'manajer' && $kerusakan->status === 'disetujui_asisten') {
        // Manajer menyetujui
        $kerusakan->status = 'disetujui';
    } else {
        return redirect()->route('kerusakan.pekerja')->with('error', 'Laporan tidak dapat disetujui pada status saat ini.');
    }

    $kerusakan->save();

    return redirect()->route('kerusakan.pekerja')->with('success', 'Kerusakan berhasil disetujui.');
}
    public function reject(Request $request, $id_kerusakan)
    {
        $kerusakan = Kerusakan::findOrFail($id_kerusakan);
        $role = Auth::user()->role;

        if ($role === 'asisten_manajer' && $kerusakan->status === 'sedang diproses') {
            $kerusakan->status = 'ditolak_asisten';
        } elseif ($role === 'manajer' && $kerusakan->status === 'ditolak_asisten') {
            $kerusakan->status = 'ditolak';
        } else {
            return redirect()->route('kerusakan.pekerja')->with('error', 'Laporan tidak dapat ditolak pada status saat ini.');
        }

        $kerusakan->save();

        return redirect()->route('kerusakan.pekerja')->with('success', 'Kerusakan berhasil ditolak.');
    }
}
