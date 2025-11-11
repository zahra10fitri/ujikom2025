@extends('admin.template')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Data Produk</h3>

    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Tanggal Upload</th>
                <th>Toko</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $p)
            <tr>
                <td>{{ $p->id_produk }}</td>
                <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>{{ $p->stok }}</td>
                <td>{{ $p->tanggal_upload }}</td>
                <td>{{ $p->toko->nama_toko ?? '-' }}</td>

                <td>
                    <a href="{{ route('admin.produk.edit', $p->id_produk) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.produk.delete', $p->id_produk) }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus produk ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
