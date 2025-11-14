<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #f2f4f7;
        }
        .login-card {
            max-width: 420px;
            margin: 60px auto;
            padding: 25px;
            border-radius: 12px;
            background: white;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
        }
        .login-title {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
        .register-link {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="text-center login-title mb-4">Login</h3>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus placeholder="Masukkan username">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>

            <button class="btn btn-primary mt-2">Masuk</button>

            <div class="text-center mt-3 register-link">
                Belum punya akun? 
                <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>

        </form>
    </div>

</body>
</html>
