<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMA Negeri 1 Ceria')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        padding-top: 70px;
    }

    /* Hero */
    .hero {
        position: relative;
        width: 100%;
        height: 100vh;
        background: url("{{ asset('storage/images/banner.jpg') }}") no-repeat center center/cover;
    }
    .hero-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        /* background: rgba(194, 54, 54, 0.4); */
    }
    .hero-content {
    position: absolute;
    top: 50%;
    left: 5%; /* geser ke kiri */
    transform: translateY(-50%); /* hanya vertikal */
    text-align: left; /* teks rata kiri */
    color: white;
    max-width: 500px; /* biar teks tidak terlalu panjang */

}

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px black;

    }
    .hero-content p {

        margin-top: 20px;
        color:  #34d376;
    }

    /* WARNA SMARTKANTIN */
    .brand-text {
        color: rgb(197, 168, 27) !important;
        font-weight: 700;
        letter-spacing: 1px;
    }
</style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container">

            <img src="{{ asset('storage/images/logo.png') }}"
                 alt="Logo"
                 class="navbar-brand"
                 style="height: 60px; width: 60px; margin-right: 15px;">

            <!-- BRAND -->
            <a class="navbar-brand fw-bold brand-text" href="#">
                SMARTKANTIN
            </a>

            <!-- Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('toko') }}">Toko</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Produk</a></li>

                    <li class="nav-item">
                        <a class="btn btn-warning ms-3 px-4 rounded-pill fw-bold" href="#">
                            Login
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    {{-- KONTEN --}}
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
