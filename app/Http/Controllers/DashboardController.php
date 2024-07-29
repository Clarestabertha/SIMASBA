<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerusakan;
use App\Models\Tindaklanjut;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function grafikDashboard()
    {
        $oneYearAgo = Carbon::now()->subYear();
        
        // Data Kerusakan
        $kerusakan = Kerusakan::where('tanggal', '>=', $oneYearAgo)->get();
        $kerusakanPerBulan = $kerusakan->groupBy(function($date) {
            return Carbon::parse($date->tanggal)->format('m');
        });
        $monthsInYear = range(1, 12);
        $dataKerusakan = [];
        foreach ($monthsInYear as $month) {
            $monthStr = str_pad($month, 2, '0', STR_PAD_LEFT);
            $dataKerusakan[$monthStr] = isset($kerusakanPerBulan[$monthStr]) ? $kerusakanPerBulan[$monthStr]->count() : 0;
        }
        $labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $valuesKerusakan = array_values($dataKerusakan);

        // Data Tindak Lanjut
        $tindaklanjut = Tindaklanjut::where('tanggal', '>=', $oneYearAgo)->get();
        $tindaklanjutPerBulan = $tindaklanjut->groupBy(function($date) {
            return Carbon::parse($date->tanggal)->format('m');
        });
        $dataTindaklanjut = [];
        foreach ($monthsInYear as $month) {
            $monthStr = str_pad($month, 2, '0', STR_PAD_LEFT);
            $dataTindaklanjut[$monthStr] = isset($tindaklanjutPerBulan[$monthStr]) ? $tindaklanjutPerBulan[$monthStr]->count() : 0;
        }
        $valuesTindaklanjut = array_values($dataTindaklanjut);

        // Jumlah total data
        $totalKerusakan = $kerusakan->count();
        $totalTindaklanjut = $tindaklanjut->count();

        return view('dashboard', compact('labels', 'valuesKerusakan', 'valuesTindaklanjut', 'totalKerusakan', 'totalTindaklanjut'));
    }
}
