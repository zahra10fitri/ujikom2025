@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Tambah Toko</h3>

    <form action="{{ route('admin.toko.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Upload Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kontak Toko</label>
            <input type="text" name="kontak_toko" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>User Pemilik</label>
            <select name="id_user" class="form-control" required>
                <option value="">Pilih User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.toko') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
