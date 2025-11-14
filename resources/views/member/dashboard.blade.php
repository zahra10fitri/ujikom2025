@extends('member.template')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard Member</h1>

    {{-- CEK: Member belum punya toko --}}
    @if (!$toko)
        <div class="card shadow-sm p-4">
            <h4>Buat Toko Kamu</h4>
            <p class="text-muted">Isi data toko kamu agar bisa mulai menjual produk.</p>

            <form action="{{ route('member.toko.store') }}" method="POST" enctype="multipart/form-data">
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

                <button class="btn btn-success">Simpan</button>
            </form>
        </div>

    {{-- CEK: Member sudah punya toko --}}
    @else
        {{-- UPDATE TOKO --}}
        <div class="card shadow-sm p-4 mb-4">
            <h4>Data Toko Kamu</h4>
            <p class="text-muted">Kamu bisa mengupdate data toko di bawah ini.</p>

            <form action="{{ route('member.toko.update', $toko->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label>Upload Gambar (opsional)</label>
                    <input type="file" name="gambar" class="form-control">
                    @if($toko->gambar)
                        <img src="{{ asset('storage/'.$toko->gambar) }}" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                <div class="mb-3">
                    <label>Kontak Toko</label>
                    <input type="text" name="kontak_toko" class="form-control" value="{{ $toko->kontak_toko }}" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $toko->alamat }}" required>
                </div>

                <button class="btn btn-primary">Update Toko</button>
            </form>
        </div>

        {{-- LIST PRODUK --}}
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Produk Kamu
            </div>

            <div class="card-body">
                <a href="{{ route('member.produk.create') }}" class="btn btn-success mb-3">Tambah Produk</a>

                @if ($produks->count() > 0)
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produks as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $p->nama_produk }}</td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>{{ $p->stok }}</td>
                            <td>{{ $p->deskripsi }}</td>

                            <td>
                                @if ($p->gambarproduks->count() > 0)
                                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                                        @foreach ($p->gambarproduks as $g)
                                            <img src="{{ asset('storage/' . $g->nama_gambar) }}"
                                                 width="100"
                                                 class="rounded mb-1">
                                        @endforeach
                                    </div>
                                @else
                                    <img src="{{ asset('images/default.png') }}"
                                         width="80"
                                         class="rounded">
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('member.produk.edit', $p->id) }}"
                                   class="btn btn-warning btn-sm mb-1">Edit</a>

                                <form action="{{ route('member.produk.destroy', $p->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin hapus produk ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @else
                    <p class="text-muted">Belum ada produk.</p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
