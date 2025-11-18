<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #4A90E2;
            --dark-blue: #2C5AA0;
            --light-blue: #E6F2FF;
            --sidebar-hover: #3A7BC8;
            --text-light: #FFFFFF;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            color: var(--text-light);
            flex-shrink: 0;
            box-shadow: var(--shadow);
            transition: var(--transition);
            z-index: 1000;
        }

        .sidebar .logo {
            font-size: 1.8rem;
            text-align: center;
            padding: 20px 0;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            letter-spacing: 1px;
        }

        .sidebar .logo i {
            margin-right: 10px;
            font-size: 1.5rem;
        }

        .sidebar a {
            color: var(--text-light);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            border-left-color: var(--text-light);
            transform: translateX(5px);
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .badge-pending {
            background-color: #ff4d4f;
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 12px;
            margin-left: auto;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f5f7fa;
            overflow-y: auto;
        }

        .content-header {
            background-color: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-header h1 {
            color: var(--dark-blue);
            font-weight: 600;
            margin: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid var(--primary-blue);
        }

        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background-color: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                height: 100vh;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: block;
            }
        }
    </style>
</head>
<body>

@php
    use App\Models\User;
    $pendingCount = User::where('role', 'member')->where('status', 'pending')->count();
@endphp

<button class="toggle-sidebar" id="toggleSidebar">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar" id="sidebar">
    <div class="logo"><i class="fas fa-store"></i>Marketplace</div>
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
    <a href="{{ route('admin.user') }}">
        <span><i class="fas fa-users"></i> Pengguna</span>
        @if($pendingCount > 0)
            <span class="badge-pending">{{ $pendingCount }}</span>
        @endif
    </a>
    <a href="{{ route('admin.toko') }}"><i class="fas fa-store"></i> Manajemen Toko</a>
    <a href="{{ route('admin.kategori') }}"><i class="fas fa-th-list"></i> Manajemen Kategori Produk</a>
    <a href="{{ route('admin.produk') }}"><i class="fas fa-box-open"></i> Manajemen Produk</a>
    {{-- <a href="{{ route('admin.gambar-produk') }}"><i class="fas fa-images"></i> Manajemen Gambar Produk</a> --}}
</div>

<div class="content">
    <div class="content-header">
        <h1>@yield('page-title', 'Dashboard')</h1>
        <div class="user-profile">
            <span>{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>
    </div>
    @yield('content')
</div>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>

</body>
</html>