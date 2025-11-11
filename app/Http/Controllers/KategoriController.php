<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return view('admin.kategori', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|min:3'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        return view('admin.kategori-edit', compact('kategori'));
    }

    public function update(Request $request, $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        $request->validate([
            'nama_kategori' => 'required|min:3'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id_kategori)
    {
        Kategori::destroy($id_kategori);
        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
