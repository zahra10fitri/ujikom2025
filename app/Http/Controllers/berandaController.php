<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Http\Request;

class berandaController extends Controller
{
    //
   public function index()
{
    $produks = Produk::latest()->take(8)->get(); // ambil 8 produk terbaru
    return view('beranda', compact('produks'));
}
public function semuaProduk(Request $request)
{
    $kategori = Kategori::all(); // untuk dropdown filter

    $query = Produk::with('gambar_produk', 'kategori');

    // FILTER KATEGORI
    if ($request->kategori) {
        $query->where('id_kategori', $request->kategori);
    }

    // PRODUK LIST
    $produks = $query->latest()->paginate(12);

    return view('produk', compact('produks', 'kategori'));
}
public function detail($id)
{
    $produk = Produk::with('gambar_produk')->findOrFail($id);
    return view('detailproduk', compact('produk'));
}

public function favorite($id)
{
    // logikanya terserah kamu, misalnya save ke tabel favorit
    return back()->with('success', 'Berhasil ditambahkan ke favorit!');
}
public function indextoko()
    {
        $toko = Toko::all();
        return view('toko', compact('toko'));
    }

    // Halaman detail toko
    public function detailtoko($id)
    {
        $toko = Toko::with('produks.gambar_produk')->findOrFail($id);

        return view('toko.detail', compact('toko'));
    }
}
