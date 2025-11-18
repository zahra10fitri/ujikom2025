<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f2f4f7">

<div class="container mt-4">
    <h1 class="mb-4">Edit Produk</h1>

    <div class="card shadow-sm p-4">
       <form action="{{ route('member.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST') {{-- karena route update POST --}}

            <!-- Nama Produk -->
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $produk->id_kategori == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $produk->deskripsi }}</textarea>
            </div>

            <!-- Upload Gambar Baru -->
            <div class="mb-3">
                <label class="form-label">Gambar Produk (bisa upload banyak)</label>
                <input type="file" name="gambar_produk[]" class="form-control" multiple>

                <!-- Gambar lama -->
               @if($produk->gambarproduks && $produk->gambarproduks->count() > 0)
                <p class="mt-3 mb-1 fw-bold">Gambar Saat Ini:</p>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($produk->gambarproduks as $g)
                        <img src="{{ asset('storage/'.$g->nama_gambar) }}" width="120" class="rounded shadow-sm">
                    @endforeach
                </div>
              @endif
            </div>

            <button class="btn btn-primary">Update Produk</button>
            <a href="{{ route('member.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
