@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Gambar Produk</h3>

    <form action="{{ route('admin.gambar.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Produk</label>
            <select name="id_produk" class="form-control" required>
                @foreach ($produk as $p)
                <option value="{{ $p->id_produk }}"
                    {{ $p->id_produk == $data->id_produk ? 'selected' : '' }}>
                    {{ $p->nama_produk }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            <img src="/uploads/gambar_produk/{{ $data->nama_gambar }}" width="120" class="rounded">
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="nama_gambar" class="form-control">
        </div>

        <button class="btn btn-warning">Update</button>

        <a href="{{ route('admin.gambar') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
