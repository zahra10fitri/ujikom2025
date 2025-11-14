<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gambar_produk;
use App\Models\Produk;

class GambarProdukController extends Controller
{
    public function index()
    {
        $data = Gambar_produk::with('produk')->get();
        return view('admin.gambar-produk', compact('data'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('admin.gambar-produk-create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'nama_gambar' => 'required|image|max:2048'
        ]);

        $file = $request->file('nama_gambar');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('gambar_produk'), $namaFile);

        Gambar_produk::create([
            'id_produk' => $request->id_produk,
            'nama_gambar' => $namaFile,
        ]);

        return redirect()->route('admin.gambar-produk')->with('success', 'Gambar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Gambar_produk::findOrFail($id);
        $produk = Produk::all();
        return view('admin.gambar-produk-edit', compact('data', 'produk'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'id_produk' => 'required|exists:produks,id_produk',
    ]);

    $gambar = Gambar_produk::findOrFail($id);
    $gambar->id_produk = $request->id_produk;
    $gambar->save();

    return redirect()->route('admin.gambar-produk.index')
                     ->with('success', 'Gambar berhasil dipindahkan ke produk baru.');
}

    public function destroy($id)
    {
        $data = Gambar_produk::findOrFail($id);

        if (file_exists(public_path('gambar_produk/' . $data->nama_gambar))) {
            unlink(public_path('gambar_produk/' . $data->nama_gambar));
        }

        $data->delete();

        return redirect()->route('admin.gambar-produk')->with('success', 'Gambar berhasil dihapus');
    }
}
