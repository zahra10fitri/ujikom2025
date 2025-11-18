<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Gambar_produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    // =======================================
    // DASHBOARD MEMBER
    // =======================================
    public function index()
    {
        $user = Auth::user();

        if ($user->status !== 'approved') {
            return redirect()->route('login')->with('error', 'Akun Anda belum disetujui admin.');
        }

        $toko = $user->toko;
        $produks = $toko ? $toko->produk : collect();

        return view('member.dashboard', compact('user', 'toko', 'produks'));
    }

    // =======================================
    // CREATE TOKO
    // =======================================
    public function createToko()
    {
        return view('member.toko-create');
    }

    public function storeToko(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required',
            'deskripsi' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $filename = null;
        if ($request->hasFile('gambar')) {
            $filename = $request->file('gambar')->store('toko', 'public');
        }

        Toko::create([
            'user_id' => Auth::id(),
            'nama_toko' => $request->nama_toko,
            'deskripsi' => $request->deskripsi,
            'kontak_toko' => $request->kontak,
            'alamat' => $request->alamat,
            'gambar' => $filename,
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Toko berhasil dibuat!');
    }

    // =======================================
    // EDIT TOKO
    // =======================================
    public function editToko($id)
    {
      $toko = Toko::findOrFail($id);

    // Cek agar member tidak edit toko orang lain
    if ($toko->user_id != Auth::id()) {
        return redirect()->back()->with('error', 'Tidak boleh edit toko orang lain!');
    }

    return view('member.toko-edit', compact('toko'));
    }

public function updateToko(Request $request, $id)
{
    $toko = Toko::findOrFail($id);

    if ($toko->user_id != Auth::id()) {
        return redirect()->back()->with('error', 'Akses ditolak!');
    }

    $request->validate([
        'nama_toko' => 'required',
        'deskripsi' => 'nullable',
        'kontak_toko' => 'nullable',
        'alamat' => 'nullable',
        'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max=2048'
    ]);

    // update data
    $toko->nama_toko = $request->nama_toko;
    $toko->deskripsi = $request->deskripsi;
    $toko->kontak_toko = $request->kontak_toko;
    $toko->alamat = $request->alamat;

    // update gambar
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('toko', 'public');
        $toko->gambar = $path;
    }

    $toko->save();

    return redirect()->route('member.dashboard')->with('success', 'Toko berhasil diperbarui!');
}


    // =======================================
    // PRODUK INDEX
    // =======================================
    public function produkIndex()
    {
        $user = Auth::user();
        $toko = $user->toko;

        if (!$toko) {
            return redirect()->route('member.dashboard')
                ->with('error', 'Buat toko terlebih dahulu sebelum menambah produk.');
        }

        $produks = $toko->produk;

        return view('member.produk-index', compact('produks', 'toko'));
    }

    // =======================================
    // CREATE PRODUK
    // =======================================
    public function createProduk()
    {
        $user = Auth::user();

        $toko = Toko::where('user_id', $user->id)->get();
        $kategori = Kategori::all();

        return view('member.produk-create', compact('kategori', 'toko'));
    }

    // =======================================
    // STORE PRODUK
    // =======================================
    public function storeProduk(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar_produk.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $toko = Toko::where('user_id', Auth::id())->first();
        if (!$toko) {
            return back()->with('error', 'Toko belum dibuat!');
        }

        $produk = Produk::create([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'tanggal_upload' => now(),
            'id_toko' => $toko->id_toko,
        ]);

        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                $path = $file->store('produk', 'public');
                Gambar_produk::create([
                    'id_produk' => $produk->id_produk,
                    'nama_gambar' => $path
                ]);
            }
        }

        return redirect()->route('member.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    // =======================================
    // EDIT PRODUK
    // =======================================
    public function editProduk($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->toko->user_id !== Auth::id()) { abort(403); }

        $kategori = Kategori::all();

        return view('member.produk-edit', compact('produk', 'kategori'));
    }

    // =======================================
    // UPDATE PRODUK
    // =======================================
    public function updateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->toko->user_id !== Auth::id()) { abort(403); }

        $request->validate([
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Produk berhasil diperbarui!');
    }

    // =======================================
    // DELETE PRODUK
    // =======================================
    public function deleteProduk($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->toko->user_id !== Auth::id()) { abort(403); }

        foreach ($produk->gambar_produk as $gbr) {
            if (Storage::disk('public')->exists($gbr->nama_gambar)) {
                Storage::disk('public')->delete($gbr->nama_gambar);
            }
            $gbr->delete();
        }

        $produk->delete();

        return redirect()->route('member.dashboard')->with('success', 'Produk berhasil dihapus!');
    }
}
