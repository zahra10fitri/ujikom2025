@extends('admin.template')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Edit Produk</h3>

    <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">-- pilih kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id_kategori }}" {{ $produk->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nama Produk --}}
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control"
                   value="{{ old('nama_produk', $produk->nama_produk) }}" required>
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                   value="{{ old('harga', $produk->harga) }}" required>
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control"
                   value="{{ old('stok', $produk->stok) }}" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        {{-- Tanggal Upload --}}
        <div class="mb-3">
            <label class="form-label">Tanggal Upload</label>
            <input type="date" name="tanggal_upload" class="form-control"
                   value="{{ old('tanggal_upload', $produk->tanggal_upload) }}" required>
        </div>

        {{-- Toko --}}
        <div class="mb-3">
            <label class="form-label">Toko</label>
            <select name="id_toko" class="form-control" required>
                <option value="">-- pilih toko --</option>
                @foreach ($toko as $t)
                    <option value="{{ $t->id_toko }}" {{ $produk->id_toko == $t->id_toko ? 'selected' : '' }}>
                        {{ $t->nama_toko }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Upload Banyak Gambar --}}
        <div class="mb-3">
            <label class="form-label">Gambar Produk (bisa lebih dari satu)</label>
            <input type="file" name="gambar_produk[]" class="form-control" multiple accept="image/*" onchange="previewImages(event)">
            <small class="text-muted">Kamu bisa pilih beberapa gambar (JPG, PNG, JPEG, maks 2MB)</small>

            {{-- Gambar Lama --}}
           <div class="mt-3 d-flex flex-wrap gap-2">
                @foreach ($produk->gambar_produk as $g)
                    <img src="{{ asset('storage/' . $g->nama_gambar) }}"
                        width="120" height="120"
                        class="rounded shadow-sm object-fit-cover"
                        alt="{{ $produk->nama_produk }}">
                @endforeach
            </div>


            {{-- Preview Gambar Baru --}}
            <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2"></div>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.produk') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- Script Preview --}}
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
