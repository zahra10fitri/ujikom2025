@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Toko</h3>

    <form action="{{ route('admin.toko.update', $toko->id_toko) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control" value="{{ $toko->nama_toko }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $toko->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label><br>
            @if($toko->gambar)
                <img src="{{ asset('storage/' . $toko->gambar) }}" width="80" class="mb-2">
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kontak Toko</label>
            <input type="text" name="kontak_toko" class="form-control" value="{{ $toko->kontak_toko }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $toko->alamat }}" required>
        </div>

        <div class="mb-3">
            <label>User Pemilik</label>
            <select name="id_user" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $toko->id_user == $user->id ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="{{ route('admin.toko') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
