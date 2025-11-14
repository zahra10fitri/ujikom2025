@extends('admin.template')

@section('content')

<div class="container mt-4">
    <h3 class="mb-3">Tambah Gambar Produk</h3>

    <form action="{{ route('admin.gambar-produk.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Produk</label>
            <select name="id_produk" id="produkSelect" class="form-control" required>
                <option value="">-- pilih produk --</option>
                @foreach ($produk as $p)
                    <option value="{{ $p->id_produk }}" data-nama="{{ Str::slug($p->nama_produk) }}">
                        {{ $p->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.gambar-produk') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection

@section('scripts')
<script>
    const produkSelect = document.getElementById('produkSelect');
    const namaGambar = document.getElementById('namaGambar');

    produkSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const slugNama = selectedOption.getAttribute('data-nama');

        if(slugNama) {
            // otomatis isi input nama_gambar
            namaGambar.value = slugNama + '-1.jpg';
        } else {
            namaGambar.value = '';
        }
    });
</script>
@endsection
