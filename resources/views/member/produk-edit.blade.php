@extends('member.template')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Produk</h1>

    <div class="card shadow-sm p-4">
        <form action="{{ route('member.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Produk --}}
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $produk->id_kategori == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Harga --}}
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $produk->deskripsi }}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-3">
                <label>Gambar Produk (Bisa upload multiple)</label>
                <input type="file" name="gambar_produk[]" class="form-control" multiple>

                {{-- Preview gambar lama --}}
                @if($produk->gambarproduks->count() > 0)
                    <p class="mt-2 mb-1">Gambar Saat Ini:</p>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($produk->gambarproduks as $g)
                            <img src="{{ asset('storage/'.$g->nama_gambar) }}" alt="Gambar Produk" width="120" class="rounded">
                        @endforeach
                    </div>
                @endif
            </div>

            <button class="btn btn-primary">Update Produk</button>
            <a href="{{ route('member.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
