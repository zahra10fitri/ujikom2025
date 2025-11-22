<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smartkantin')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            background: url("{{ asset('storage/images/t4.png') }}") no-repeat center center/cover;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
        }
        .hero-content {
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateY(-50%);
            text-align: left;
            color: white;
            max-width: 500px;
        }
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px black;
        }
        .hero-content p {
            margin-top: 20px;
            color: #d88037;
        }

        /* WARNA SMARTKANTIN */
        .brand-text {
            color: rgb(235, 121, 45) !important;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .hover-shadow {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .card-body h6 { font-size: 1rem; }
        .card-body p { font-size: 0.875rem; }
        /* CARD */
        .product-card {
            padding: 15px;
            border-radius: 15px;
            transition: 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* GAMBAR PRODUK KECIL */
        .product-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            display: block;
            margin: 10px auto 0 auto;
        }

    </style>

    @yield('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container">
            <img src="{{ asset('storage/images/logo.png') }}"
                 alt="Logo"
                 class="navbar-brand"
                 style="height: 60px; width: 60px; margin-right: 15px;">

            <a class="navbar-brand fw-bold brand-text" href="#">SMARTKANTIN</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('toko') }}">Toko</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('produk')}}">Produk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- KONTEN HALAMAN --}}
    @yield('content')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Section untuk halaman yang membutuhkan JS tambahan --}}
    @yield('scripts')

</body>
</html>
