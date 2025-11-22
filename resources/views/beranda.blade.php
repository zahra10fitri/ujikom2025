@extends('template')

@section('title', 'Beranda')

@section('content')

{{-- HERO SECTION --}}
<div class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="fw-bold" style="font-family:'Poppins', sans-serif; line-height:1.1; font-size:4rem;">
            <span style="color:#d8541f;">Pesan Makanan</span> & Praktis<br>
            <span style="color:white;">Tanpa Antre!</span>
        </h1>

        <p class="lead mt-3 fw-semibold" style="color: #e4662c;">
            Nikmati kemudahan memesan makanan favorit langsung dari Smartkantin, cepat, mudah, dan nyaman.
        </p>
    </div>
</div>

{{-- LAYANAN SECTION --}}
<section class="py-5" style="background: #fdf4e3;">
    <div class="container text-center">

        <h5 class="fw-semibold mb-1" style="color:#c25421;">3 layanan utama Smartkantin yang bisa kamu pesan online</h5>
        <hr class="mx-auto mb-5" style="width:180px; height:3px; border:0; background:#ffb848;">

        <div class="row justify-content-center">

            <div class="col-12 col-md-4 mb-4">
                <img src="{{ asset('storage/images/pesanan.png') }}" style="width:70px; height:70px; margin-bottom:15px;">
                <h4 class="fw-bold">Pesan</h4>
                <p class="text-muted px-3">Pesan makanan favoritmu langsung dari aplikasi, praktis tanpa antre di kantin.</p>
            </div>

            <div class="col-12 col-md-4 mb-4">
                <img src="{{ asset('storage/images/memasak.png') }}" style="width:70px; height:70px; margin-bottom:15px;">
                <h4 class="fw-bold">Siap Dimasak</h4>
                <p class="text-muted px-3">Pesananmu langsung disiapkan dan dimasak oleh kantin, siap untuk diantar.</p>
            </div>

            <div class="col-12 col-md-4 mb-4">
                <img src="{{ asset('storage/images/antar.png') }}" style="width:70px; height:70px; margin-bottom:15px;">
                <h4 class="fw-bold">Siap Diantar</h4>
                <p class="text-muted px-3">Nikmati makananmu tanpa ribet, kantin akan mengantarnya langsung ke kelasmu.</p>
            </div>

        </div>
    </div>
</section>

{{-- CATEGORY SECTION --}}
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="font-family:'Poppins', sans-serif;">Kategori</h2>
    </div>

    <div class="row text-center">

        @php
            $kategori = [
                ['img' => 'manis.webp', 'nama' => 'makanan manis'],
                ['img' => 'pedas.jpeg', 'nama' => 'makanan pedas'],
                ['img' => 'minuman.jpg', 'nama' => 'minuman'],
                ['img' => 'gorengan.jpg', 'nama' => 'gorengan'],
                ['img' => 'snack.jpg', 'nama' => 'snack'],
                ['img' => 'roti.webp', 'nama' => 'roti'],
            ];
        @endphp

        @foreach ($kategori as $k)
            <div class="col-6 col-md-3 col-lg-2 mb-4">
                <img src="{{ asset('storage/images/' . $k['img']) }}" class="rounded-circle img-fluid mb-2" alt="{{ $k['nama'] }}">
                <p class="fw-semibold">{{ $k['nama'] }}</p>
            </div>
        @endforeach

    </div>
</section>
{{-- PRODUK TERBARU --}}
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="font-family:'Poppins', sans-serif;">Produk Terbaru</h2>
        <a href="{{ route('produk') }}" class="btn btn-success">Lihat Semua</a>
    </div>

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
                          <a href="{{ route('produk.detail', $p->id_produk) }}"
                            class="btn btn-outline-success btn-sm mt-2"
                            style="border-radius:20px; font-weight:600;">
                                Lihat Produk
                            </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada produk.</p>
        @endforelse
    </div>
</section>
@endsection
