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

        return view('asmen.tindaklanjut', compact('tindaklanjut'));
    }
}
