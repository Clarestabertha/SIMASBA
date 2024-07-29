<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class PekerjaController extends Controller
{
    public function index(){
        return view('pekerja.homepage');
    }
    public function panduan(){
        return view('pekerja.panduan');
    }
}
