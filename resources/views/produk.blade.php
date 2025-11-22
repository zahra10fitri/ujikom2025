@extends('template')

@section('title', 'Semua Produk')

@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4" style="font-family:'Poppins', sans-serif;">Semua Produk</h2>

    {{-- FILTER KATEGORI --}}
    <form method="GET" action="{{ route('produk') }}" class="mb-4">
        <div class="row g-2">

            <div class="col-md-4">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}"
                            {{ request('kategori') == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100" type="submit">Filter</button>
            </div>

        </div>
    </form>

    {{-- DAFTAR PRODUK --}}
<section class="container my-5">

    <div class="row g-4">
        @forelse ($produks as $p)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card h-100 border-0 shadow-sm position-relative">

                    {{-- Tombol Favorite --}}
                    <a href="{{ route('produk.favorite', $p->id_produk) }}"
                        class="position-absolute top-0 end-0 m-2 p-2 bg-white rounded-circle shadow-sm"
                        style="z-index:10;">
                        <i class="fa-regular fa-heart text-danger"></i>
                    </a>

                    {{-- GAMBAR PRODUK KECIL --}}
                    @if ($p->gambar_produk->count() > 0)
                        <img src="{{ asset('storage/' . $p->gambar_produk[0]->nama_gambar) }}"
                            class="product-img"
                            alt="{{ $p->nama_produk }}">
                    @else
                        <img src="{{ asset('no-image.png') }}"
                            class="product-img"
                            alt="Gambar tidak tersedia">
                    @endif

                    <div class="card-body text-center">
                        <h6 class="fw-bold mb-1">{{ $p->nama_produk }}</h6>
                        <p class="text-success fw-bold">Rp {{ number_format($p->harga) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada produk.</p>
        @endforelse
    </div>
</section>

    <div class="mt-4">
        {{ $produks->links() }}
    </div>

</div>

@endsection
