@extends('template')

@section('title', 'Beranda')

@section('content')
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
        <h1 class="fw-bold" style="font-family:'Poppins', sans-serif; line-height:1.05; font-size:4rem;">
            <span style="color:#27ae60;">Belanja  dengan mudah </span> 
            & Praktis<br>
            <span style="color:white;">Untukmu</span>
        </h1>

            <p class="lead mt-3 fw-semibold" style="color: #34d376;">
                "Nikmati kemudahan pesan makanan di dengan Smartkantin tanpa antre!"
            </p>
        </div>
    </div>
    <!-- CATEGORY SECTION -->
<section class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="font-family:'Poppins', sans-serif;">Kategori</h2>
        <a href="#" class="btn btn-success">Lihat Semua</a>
    </div>

    <div class="row text-center">

        <div class="col-6 col-md-3 col-lg-2 mb-4">
            <img src="{{ asset('storage/images/manis.webp') }}" class="rounded-circle img-fluid mb-2" alt="">
            <p class="fw-semibold">makanan manis</p>
        </div>

        <div class="col-6 col-md-3 col-lg-2 mb-4">
            <img src="{{ asset('storage/images/pedas.jpeg') }}" class="rounded-circle img-fluid mb-2" alt="">
            <p class="fw-semibold">makanan pedas</p>
        </div>

        <div class="col-6 col-md-3 col-lg-2 mb-4">
            <img src="{{ asset('storage/images/minuman.jpg') }}" class="rounded-circle img-fluid mb-2" alt="">
            <p class="fw-semibold">minuman</p>
        </div>

        <div class="col-6 col-md-3 col-lg-2 mb-4">
            <img src="{{ asset('storage/images/gorengan.jpg') }}" class="rounded-circle img-fluid mb-2" alt="">
            <p class="fw-semibold">gorengan</p>
        </div>

        <div class="col-6 col-md-3 col-lg-2 mb-4">
            <img src="{{ asset('storage/images/snack.jpg') }}" class="rounded-circle img-fluid mb-2" alt="">
            <p class="fw-semibold">snack</p>
        </div>

        <div class="col-6 col-md-3 col-lg-2 mb-4">
            <img src="{{ asset('storage/images/roti.webp') }}" class="rounded-circle img-fluid mb-2" alt="">
            <p class="fw-semibold">roti</p>
        </div>

    </div>

</section>
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="font-family:'Poppins', sans-serif;">Produk Terbaru</h2>
        <a href="#" class="btn btn-success">Lihat Semua</a>
    </div>

    <div class="row g-4">
        {{-- Produk 1 --}}
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow">
                <div class="position-relative">
                    <img src="{{ asset('storage/images/donat.jpg') }}" class="card-img-top rounded-3" alt="Donat Gula">
                </div>
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-1">Donat Gula</h6>
                    <p class="text-muted mb-0">Rp 5.000</p>
                </div>
            </div>
        </div>

        {{-- Produk 2 --}}
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow">
                <img src="{{ asset('storage/images/roti.jpg') }}" class="card-img-top rounded-3" alt="Roti Coklat">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-1">Roti Coklat</h6>
                    <p class="text-muted mb-0">Rp 5.000</p>
                </div>
            </div>
        </div>

        {{-- Produk 3 --}}
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow">
                <img src="{{ asset('storage/images/nabati.jpg') }}" class="card-img-top rounded-3" alt="Nabati">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-1">Nabati</h6>
                    <p class="text-muted mb-0">Rp 3.000</p>
                </div>
            </div>
        </div>

        {{-- Produk 4 --}}
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow">
                <img src="{{ asset('storage/images/makaroni.jpg') }}" class="card-img-top rounded-3" alt="Makaroni Pedas">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-1">Makaroni Pedas</h6>
                    <p class="text-muted mb-0">Rp 10.000</p>
                </div>
            </div>
        </div>

        {{-- Produk 5 --}}
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm rounded-3 hover-shadow">
                <img src="{{ asset('storage/images/matcha.jpeg') }}" class="card-img-top rounded-3" alt="Matcha">
                <div class="card-body text-center">
                    <h6 class="fw-bold mb-1">Matcha</h6>
                    <p class="text-muted mb-0">Rp 10.000</p>
                </div>
            </div>
        </div>
    </div>
</section>
{{--
<div class="container my-5">
    <h3 class="fw-bold mb-4">Best Selling Products</h3>
    <div class="row">
        @foreach ($produks as $p)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/'.$p->gambar) }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->nama_produk }}</h5>
                        <p class="card-text">Rp {{ number_format($p->harga) }}</p>
                        <a href="{{ route('produk.show', $p->id_produk) }}" class="btn btn-success">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

@endsection
