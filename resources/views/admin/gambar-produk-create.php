
@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Tambah Gambar Produk</h3>

    <form action="{{ route('admin.gambar-produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Produk</label>
            <select name="id_produk" class="form-control" required>
                <option value="">-- pilih produk --</option>
                @foreach ($produk as $p)
                <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Gambar</label>
            <input type="file" name="nama_gambar" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.gambar-produk') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
