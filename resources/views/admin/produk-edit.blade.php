@extends('admin.template')

@section('content')
<div class="container mt-4">

    <h3>Edit Produk</h3>

    <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="id_kategori" class="form-control" required>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id_kategori }}" {{ $produk->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Toko</label>
            <select name="id_toko" class="form-control" required>
                @foreach ($toko as $t)
                    <option value="{{ $t->id_toko }}" {{ $produk->id_toko == $t->id_toko ? 'selected' : '' }}>
                        {{ $t->nama_toko }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $produk->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Lama</label><br>
            @if ($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" width="80">
            @else
                <p class="text-muted">Tidak ada gambar</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Baru (opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
