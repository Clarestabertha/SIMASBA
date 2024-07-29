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

        // Query dengan kondisi pencarian
        $kerusakan = Kerusakan::query()
            ->where(function($query) use ($search) {
                $query->Where('tanggal', 'LIKE', "%{$search}%")
                      ->orWhere('sumber_laporan', 'LIKE', "%{$search}%")
                      ->orWhere('lokasi', 'LIKE', "%{$search}%");
            })
            ->paginate(10); // Gunakan paginate() langsung setelah query builder

        return view('asmen.kerusakan', compact('kerusakan'));
    }
}
