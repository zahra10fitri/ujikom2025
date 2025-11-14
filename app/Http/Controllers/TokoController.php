<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    // INDEX
    public function index()
    {
        $tokos = Toko::with('user')->get();
        return view('admin.toko', compact('tokos'));
    }

    // CREATE
    public function create()
    {
        $users = User::all();
        return view('admin.toko-create', compact('users'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg',
            'kontak_toko' => 'required|max:20',
            'alamat' => 'required|max:150',
            'id_user' => 'required|exists:users,id'
        ]);

        $gambarPath = null;

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('toko', 'public');
        }

        Toko::create([
        'nama_toko' => $request->nama_toko,
        'deskripsi' => $request->deskripsi,
        'gambar' => $gambarPath,
        'kontak_toko' => $request->kontak_toko,
        'alamat' => $request->alamat,
        'user_id' => $request->id_user, // <- harus sesuai nama kolom di DB
    ]);


        return redirect()->route('admin.toko')->with('success', 'Toko berhasil ditambahkan');
    }

    // EDIT
    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        $users = User::all();
        return view('admin.toko-edit', compact('toko', 'users'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_toko' => 'required|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg',
            'kontak_toko' => 'required|max:20',
            'alamat' => 'required|max:150',
            'id_user' => 'required|exists:users,id'
        ]);

        $toko = Toko::findOrFail($id);

        // Hapus gambar lama jika upload baru
        if ($request->hasFile('gambar')) {
            if ($toko->gambar && Storage::disk('public')->exists($toko->gambar)) {
                Storage::disk('public')->delete($toko->gambar);
            }
            $gambarBaru = $request->file('gambar')->store('toko', 'public');
        } else {
            $gambarBaru = $toko->gambar;
        }

        $toko->update([
            'nama_toko' => $request->nama_toko,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarBaru,
            'kontak_toko' => $request->kontak_toko,
            'alamat' => $request->alamat,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('admin.toko')->with('success', 'Toko berhasil diperbarui');
    }

    // DELETE
    public function destroy($id)
    {
        $toko = Toko::findOrFail($id);

        if ($toko->gambar && Storage::disk('public')->exists($toko->gambar)) {
            Storage::disk('public')->delete($toko->gambar);
        }

        $toko->delete();

        return redirect()->route('admin.toko')->with('success', 'Toko berhasil dihapus');
    }
}
