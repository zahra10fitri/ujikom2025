<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f7f7f7;">

<div class="container mt-4">

    <h2>Dashboard Member</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Jika user punya toko --}}
    @if(!empty($toko) && $toko->id_toko)

        <!-- INFO TOKO -->
        <div class="card mb-4">
            <div class="card-header">
                Info Toko Anda

                <a href="{{ route('member.toko.edit', $toko->id_toko) }}"
                   class="btn btn-sm btn-primary float-end">
                    EDIT TOKO 
                </a>
            </div>

            <div class="card-body">
                <p><strong>Nama Toko:</strong> {{ $toko->nama_toko }}</p>
                <p><strong>Deskripsi:</strong> {{ $toko->deskripsi }}</p>
                <p><strong>Kontak:</strong> {{ $toko->kontak_toko ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $toko->alamat }}</p>

                <p>
                    <strong>Gambar:</strong><br>
                    @if($toko->gambar)
                        <img src="{{ asset('storage/' . $toko->gambar) }}" width="150">
                    @else
                        <span class="text-muted">Belum ada gambar</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- PRODUK TOKO -->
        <div class="card">
            <div class="card-header">
                Produk Toko Anda

                <a href="{{ route('member.produk.create') }}"
                   class="btn btn-sm btn-success float-end">
                    Tambah Produk
                </a>
            </div>

            <div class="card-body">

                @if($produks->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($produks as $produk)
                            <tr>
                                <td>{{ $produk->id_produk }}</td>
                                <td>{{ $produk->nama_produk }}</td>
                                   <td>{{ $produk->kategori ? $produk->kategori->nama_kategori : '-' }}</td>
                                <td>{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>{{ $produk->deskripsi }}</td>

                                <td>
                                    @php
                                        $gambar = $produk->gambar_produk->first();
                                    @endphp

                                    @if($gambar)
                                        <img src="{{ asset('storage/' . $gambar->nama_gambar) }}" width="50">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('member.produk.edit', $produk->id_produk) }}"
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                   <form action="{{ route('member.produk.delete', $produk->id_produk) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Hapus produk ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

                @else
                    <p class="text-muted">Belum ada produk.</p>
                @endif
            </div>
        </div>

    @else
        <div class="alert alert-info">
            Anda belum memiliki toko.

            <a href="{{ route('member.toko.create') }}" class="btn btn-sm btn-primary ms-2">
                Buat Toko Baru
            </a>
        </div>
    @endif

</div>

</body>
</html>
