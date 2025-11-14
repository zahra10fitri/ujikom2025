@extends('admin.template')

@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Edit Gambar Produk</h3>

    <form action="{{ route('admin.gambar-produk.update', $gambar->id_gambar) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- PILIH PRODUK -->
        <div class="mb-3">
            <label for="id_produk" class="form-label">Produk</label>
            <select name="id_produk" id="id_produk" class="form-select" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($produk as $p)
                    <option value="{{ $p->id_produk }}" 
                        {{ $gambar->id_produk == $p->id_produk ? 'selected' : '' }}>
                        {{ $p->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- GAMBAR SAAT INI -->
        <div class="mb-3">
            <label class="form-label d-block">Gambar Saat Ini</label>
            @if ($gambar->nama_gambar)
                <img src="{{ asset('storage/' . $gambar->nama_gambar) }}" 
                     alt="Gambar {{ $gambar->produk->nama_produk ?? '' }}" 
                     width="150" height="150" 
                     class="rounded shadow-sm object-fit-cover">
            @else
                <p class="text-muted">Tidak ada gambar</p>
            @endif
        </div>

        <!-- TOMBOL -->
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.gambar-produk.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection
