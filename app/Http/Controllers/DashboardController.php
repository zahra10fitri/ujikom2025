<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
class DashboardController extends Controller
{
    //
     public function index()
    {
        return view('admin.dashboard');
    }
    public function toko()
    {
       $tokos = Toko::with('user')->get();
        return view('toko', compact('tokos'));
    }
}
