@extends('admin.template')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Data Produk</h3>

    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
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
                <td>{{ $p->deskripsi }}</td>

                {{-- Kolom Gambar --}}
                <td>
                @if ($p->gambar_produk->count() > 0)
                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                   @foreach ($p->gambar_produk as $g)
                    <img src="{{ asset('storage/' . $g->nama_gambar) }}" width="120" class="rounded mb-2">
                @endforeach

                    </div>
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Tidak ada gambar" width="80" height="80">
                @endif
            </td>
                <td>{{ $p->tanggal_upload }}</td>
                <td>{{ $p->toko->nama_toko ?? '-' }}</td>

                <td>
                    <a href="{{ route('admin.produk.edit', $p->id_produk) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                    <form action="{{ route('admin.produk.delete', $p->id_produk) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
