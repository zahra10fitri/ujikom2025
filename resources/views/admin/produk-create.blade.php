@extends('admin.template')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Tambah Produk</h3>

    {{-- Penting: enctype untuk upload file --}}
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">-- pilih kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        {{-- Nama Produk --}}
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        {{-- Tanggal Upload --}}
        <div class="mb-3">
            <label class="form-label">Tanggal Upload</label>
            <input type="date" name="tanggal_upload" class="form-control" required>
        </div>

        {{-- Toko --}}
        <div class="mb-3">
            <label class="form-label">Toko</label>
            <select name="id_toko" class="form-control" required>
                <option value="">-- pilih toko --</option>
                @foreach ($toko as $t)
                    <option value="{{ $t->id_toko }}">{{ $t->nama_toko }}</option>
                @endforeach
            </select>
        </div>

        {{-- Upload Banyak Gambar --}}
        <div class="mb-3">
            <label class="form-label">Gambar Produk (bisa lebih dari satu)</label>
            <input type="file" name="gambar_produk[]" class="form-control" multiple accept="image/*" onchange="previewImages(event)">
            <small class="text-muted">Kamu bisa pilih beberapa gambar (JPG, PNG, JPEG, maks 2MB)</small>

            {{-- Tempat preview gambar --}}
            <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2"></div>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.produk') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- Script preview gambar --}}
<script>
    function previewImages(event) {
        const container = document.getElementById('preview-container');
        container.innerHTML = '';
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) continue;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'rounded shadow-sm';
                img.width = 120;
                img.height = 120;
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
