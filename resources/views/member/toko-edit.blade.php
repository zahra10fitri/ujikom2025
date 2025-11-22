<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f2f2f2">

<div class="container mt-4">

    <h2>Edit Toko</h2>

    <div class="card p-4 shadow-sm">
        
 <form action="{{ route('member.toko.update', $toko->id_toko) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Toko</label>
                <input type="text" name="nama_toko" class="form-control" value="{{ $toko->nama_toko }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ $toko->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kontak Toko</label>
                <input type="text" name="kontak_toko" class="form-control" value="{{ $toko->kontak_toko }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $toko->alamat }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Toko</label>
                <input type="file" name="gambar" class="form-control">

                @if($toko->gambar)
                    <p class="mt-2">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $toko->gambar) }}" width="150">
                @endif
            </div>

            <button class="btn btn-primary">Update Toko</button>
            <a href="{{ route('member.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

</div>

</body>
</html>
