@extends('template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Data Toko</h3>
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
               
            </tr>
        </thead>
        <tbody>
            @foreach ($tokos as $toko)
            <tr>
                <td>{{ $toko->id_toko }}</td>
                <td>{{ $toko->nama_toko }}</td>
                <td>{{ $toko->deskripsi }}</td>

                <td>
                    @if($toko->gambar)
                        <img src="{{ asset($toko->gambar) }}" width="70" alt="Gambar Toko">
                    @else
                        <span class="text-danger">Belum ada</span>
                    @endif
                </td>

                <td>{{ $toko->kontak_toko }}</td>
                <td>{{ $toko->alamat }}</td>
                <td>{{ $toko->user_id }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
