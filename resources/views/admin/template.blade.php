<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }
        .sidebar {
            width: 220px;
            background-color: rgb(230, 47, 247);
            color: rgb(255, 255, 255);
            flex-shrink: 0;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
        }
        .sidebar .logo {
            font-size: 1.5rem;
            text-align: center;
            padding: 15px 0;
            font-weight: bold;
            background-color: #770494;


        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">Marketplace</div>
<a href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
<a href="{{ route('admin.user') }}"><i class="fas fa-store me-2"></i> User</a>
<a href="{{ route('admin.toko') }}"><i class="fas fa-store me-2"></i> Toko</a>
<a href="{{ route('admin.kategori') }}"> <i class="fas fa-th-list me-2"></i> Kategori Produk</a>
<a href="{{ route('admin.produk') }}"><i class="fas fa-box-open me-2"></i> Produk</a>
<a href="{{ route('admin.gambar-produk') }}"><i class="fas fa-images me-2"></i> Gambar Produk</a>
</div>

<div class="content">
    @yield('content')
</div>



</body>
</html>
