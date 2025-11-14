<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f2f4f7;
        }
        .register-card {
            max-width: 550px;
            margin: 60px auto;
            padding: 25px;
            border-radius: 14px;
            background: white;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.12);
        }
        .register-title {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
        .info-box {
            font-size: 14px;
            color: #555;
            background: #eef5ff;
            padding: 10px;
            border-left: 4px solid #0d6efd;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="register-card">

        <h3 class="text-center register-title mb-4">Register Akun Baru</h3>

        <!-- Info bahwa akun akan menunggu persetujuan admin -->
        <div class="info-box">
            Setelah mendaftar, akun kamu <b>akan menunggu persetujuan admin</b> sebelum bisa login dan membuka toko.
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('register.proses') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama lengkap">
            </div>

            <!-- Kontak -->
            <div class="mb-3">
                <label class="form-label">Kontak</label>
                <input type="text" name="kontak" class="form-control" required placeholder="Nomor HP atau WhatsApp">
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>

             <div class="mb-3">
                <label class="form-label">Role</label>
               <select name="role" id="role" class="form-select" required>
                <option value="member">Member</option>
            </select>
            </div>

            <button class="btn btn-primary mt-2">Daftar</button>

            <p class="text-center mt-3">
                Sudah punya akun?
                <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>

    </div>

</body>
</html>
