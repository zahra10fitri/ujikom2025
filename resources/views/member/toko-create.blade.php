<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Toko</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f2f4f7">

<div class="container mt-4 p-4 bg-white rounded shadow">
    <h3 class="mb-3">Buat Toko Baru</h3>

    <form action="{{ route('member.toko.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Toko</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('member.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
