<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Produk;
// HAPUS: use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MemberController extends Controller
{
   public function index()
{
    $user = Auth::user();
    $toko = Toko::where('user_id', $user->id)->first();
    $produks = $toko ? Produk::where('id_toko', $toko->id)->get() : collect();

    return view('member.dashboard', compact('user', 'toko', 'produks'));

}
}
