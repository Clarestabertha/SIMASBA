<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class AsistenManajerController extends Controller
{
    public function index(){
        return view('asmen.homepage');
    }
}
