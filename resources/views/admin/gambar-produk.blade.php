@extends('admin.template')

@section('content')

<h3 class="mb-3">Daftar Gambar Produk</h3>

<a href="{{ route('admin.gambar-produk.create') }}" class="btn btn-primary mb-3">
    Tambah Gambar
</a>

<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>ID Gambar</th>
            <th>Produk</th>
            <th>Nama Gambar (dari produk)</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $g)
        <tr>
            <!-- ID GAMBAR -->
            <td>{{ $g->id_gambar }}</td>

            <!-- PRODUK -->
            <td>{{ $g->produk->nama_produk ?? '-' }}</td>

            <!-- NAMA GAMBAR (ngambil dari tabel produk) -->
            <td>
                {{ $g->produk->gambar ?? 'Belum ada gambar' }}
            </td>

            <!-- AKSI -->
            <td>
                <a href="{{ route('admin.gambar-produk.edit', $g->id_gambar) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="{{ route('admin.gambar-produk.delete', $g->id_gambar) }}" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin hapus gambar ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
