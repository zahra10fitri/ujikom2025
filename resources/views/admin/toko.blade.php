@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Data Toko</h3>

    <a href="{{ route('admin.toko.create') }}" class="btn btn-primary mb-3">Tambah Toko</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Toko</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th>ID User</th>
                <th width="200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tokos as $toko)
            <tr>
                <td>{{ $toko->id_toko }}</td>
                <td>{{ $toko->nama_toko }}</td>
                <td>{{ $toko->deskripsi }}</td>

                <td>
                    @php
                        $gambarPath = $toko->gambar ? 'storage/' . $toko->gambar : 'images/default.png';
                        $fileFullPath = storage_path('app/public/' . ($toko->gambar ?? ''));
                    @endphp

                    @if($toko->gambar && file_exists($fileFullPath))
                        <img src="{{ asset($gambarPath) }}" alt="Gambar Toko" width="100">
                    @else
                        <img src="{{ asset('images/default.png') }}" alt="Tidak ada gambar" width="100">
                    @endif
                </td>

                <td>{{ $toko->kontak_toko }}</td>
                <td>{{ $toko->alamat }}</td>
                <td>{{ $toko->user_id }}</td>

                <td>
                    <a href="{{ route('admin.toko.edit', $toko->id_toko) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.toko.destroy', $toko->id_toko) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Hapus toko ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
