<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Pastikan untuk mengimpor View
use App\Models\User;

class UserController extends Controller
{
    public function index(): View
    {
        // Menghapus compact('user') karena variabel user tidak didefinisikan
        return view('manajer/permintaan_regis');
    }
}
