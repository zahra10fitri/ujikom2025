<?php

namespace App\Http\Controllers;

use App\Models\Gambar_produk;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;
use App\Models\GambarProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with(['kategori', 'toko'])
                         ->orderBy('tanggal_upload', 'desc')
                         ->get();

        return view('admin.produk', compact('produks'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $toko = Toko::all();

        return view('admin.produk-create', compact('kategori', 'toko'));
    }

 public function store(Request $req)
{
    // 1. Simpan data produk dulu
    $produk = Produk::create([
        'id_kategori' => $req->id_kategori,
        'nama_produk' => $req->nama_produk,
        'harga'       => $req->harga,
        'stok'        => $req->stok,
        'deskripsi'   => $req->deskripsi,
        'tanggal_upload' => $req->tanggal_upload,
        'id_toko'     => $req->id_toko,
    ]);

    // 2. Jika ada gambar yang diupload
    if ($req->hasFile('gambar_produk')) {
        foreach ($req->file('gambar_produk') as $file) {

            // simpan file ke storage/app/public/produk
            $path = $file->store('produk', 'public');

            // simpan ke tabel gambar_produks
            Gambar_produk::create([
                'id_produk'   => $produk->id_produk,
                'nama_gambar' => $path,
            ]);
        }
    }

    return redirect()->route('admin.produk')
                     ->with('success', 'Produk berhasil ditambahkan!');
}



    public function edit($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        $kategori = Kategori::all();
        $toko = Toko::all();

        return view('admin.produk-edit', compact('produk', 'kategori', 'toko'));
    }

public function update(Request $request, $id_produk)
{
    $produk = Produk::findOrFail($id_produk);

    $request->validate([
        'id_kategori' => 'required',
        'nama_produk' => 'required',
        'harga'       => 'required|integer',
        'stok'        => 'required|integer',
        'deskripsi'   => 'nullable',
        'id_toko'     => 'required',
        'gambar_produk.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // tambahkan validasi gambar
    ]);

    // Update data produk
    $produk->update([
        'id_kategori' => $request->id_kategori,
        'nama_produk' => $request->nama_produk,
        'harga'       => $request->harga,
        'stok'        => $request->stok,
        'deskripsi'   => $request->deskripsi,
        'id_toko'     => $request->id_toko,
    ]);

    // Upload gambar baru (jika ada)
    if ($request->hasFile('gambar_produk')) {
        foreach ($request->file('gambar_produk') as $file) {
            $filename = $file->store('produk', 'public');
            $produk->gambarProduks()->create([
                'nama_gambar' => $filename
            ]);
        }
    }

    return redirect()->route('admin.produk')->with('success', 'Produk berhasil diupdate!');
}


    public function destroy($id_produk)
    {
        Produk::where('id_produk', $id_produk)->delete();

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus!');
    }

    public function show($id)
{
    $produk = Produk::findOrFail($id); // ambil produk berdasarkan ID
    return view('detailproduk', compact('produk'));
}

}
