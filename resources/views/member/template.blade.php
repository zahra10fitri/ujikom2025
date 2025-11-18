<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 200px;
            background-color: #770494;
            color: white;
            flex-shrink: 0;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #5e0375;
        }
        .sidebar .logo {
            font-size: 1.3rem;
            text-align: center;
            padding: 15px 0;
            font-weight: bold;
            background-color: #5e0375;
        }
        .content {
            flex-grow: 1;
            padding: 25px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">Member Panel</div>
    <a href="{{ route('member.dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="{{ route('member.toko.create') }}"><i class="fas fa-store me-2"></i> Toko</a>
    <a href="{{ route('member.produk.index') }}"><i class="fas fa-box-open me-2"></i> Produk</a>
    <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
