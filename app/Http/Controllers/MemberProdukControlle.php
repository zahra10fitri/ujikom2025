<?php

namespace App\Http\Controllers;

use App\Models\Gambar_produk;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\GambarProduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberProdukController extends Controller
{
    // List produk member
    public function index()
    {
        $user = Auth::user();
        $toko = $user->toko; // pastikan relasi user->toko
        $produks = $toko ? $toko->produks()->with('kategori', 'gambarproduks')->get() : collect();

        return view('member.produk.index', compact('produks'));
    }

    // Form tambah produk
    public function create()
    {
        $kategoris = Kategori::all();
        return view('member.produk.create', compact('kategoris'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $user = Auth::user();
        $toko = $user->toko;

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $produk = Produk::create([
            'id_toko' => $toko->id,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'tanggal_upload' => now(),
        ]);

        // Upload multiple gambar
        if($request->hasFile('gambar')){
            foreach($request->file('gambar') as $file){
                $path = $file->store('produk', 'public');
                Gambar_produk::create([
                    'id_produk' => $produk->id,
                    'nama_gambar' => $path,
                ]);
            }
        }

        return redirect()->route('member.dashboard')->with('success', 'Produk berhasil ditambahkan');
    }

    // Form edit produk
    public function edit($id)
    {
        $produk = Produk::with('gambarproduks')->findOrFail($id);
        $kategoris = Kategori::all();

        return view('member.produk.edit', compact('produk', 'kategoris'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar_produk.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $produk->update([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);

        // Upload gambar baru tanpa menghapus gambar lama
        if($request->hasFile('gambar')){
            foreach($request->file('gambar') as $file){
                $path = $file->store('produk', 'public');
                Gambar_produk::create([
                    'id_produk' => $produk->id,
                    'nama_gambar' => $path,
                ]);
            }
        }

        return redirect()->route('member.dashboard')->with('success', 'Produk berhasil diupdate');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus semua gambar terkait
        foreach($produk->gambarproduks as $g){
            if(Storage::disk('public')->exists($g->nama_gambar)){
                Storage::disk('public')->delete($g->nama_gambar);
            }
            $g->delete();
        }

        $produk->delete();

        return redirect()->route('member.dashboard')->with('success', 'Produk berhasil dihapus');
    }
}
