<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;
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

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'id_toko'     => 'required',
            'nama_produk' => 'required',
            'harga'       => 'required|integer',
            'stok'        => 'required|integer',
            'deskripsi'   => 'nullable'
        ]);

        Produk::create([
            'id_kategori'    => $request->id_kategori,
            'nama_produk'    => $request->nama_produk,
            'harga'          => $request->harga,
            'stok'           => $request->stok,
            'deskripsi'      => $request->deskripsi,
            'tanggal_upload' => now(),     // WAJIB ADA
            'id_toko'        => $request->id_toko,
        ]);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan!');
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
            'id_toko'     => 'required'
        ]);

        // tanggal_upload TIDAK diubah
        $produk->update([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
            'id_toko'     => $request->id_toko,
        ]);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id_produk)
    {
        Produk::where('id_produk', $id_produk)->delete();

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus!');
    }
}
