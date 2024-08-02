<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Kerusakan;


class PekerjaController extends Controller
{
    public function index(){
        $kerusakan = Kerusakan::all();
        return view('pekerja.homepage', compact('kerusakan'));
    }
    public function panduan(){
        return view('pekerja.panduan');
    }
}
