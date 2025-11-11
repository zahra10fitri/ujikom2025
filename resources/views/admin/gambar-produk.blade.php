@extends('admin.template')

@section('content')
<h3>Daftar Gambar Produk</h3>

<a href="{{ route('admin.gambar-produk.create') }}" class="btn btn-primary mb-3">Tambah Gambar</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produk</th>
            <th>Nama Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $g)
        <tr>
            <td>{{ $g->id }}</td>

            <td>{{ $g->produk->nama_produk ?? '-' }}</td>

            <td>
                <img src="/uploads/gambar_produk/{{ $g->nama_gambar }}" width="100">
            </td>

            <td>
                <a href="{{ route('admin.gambar.edit', $g->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="{{ route('admin.gambar.delete', $g->id) }}"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus gambar ini?')">
                    Hapus
                </a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
