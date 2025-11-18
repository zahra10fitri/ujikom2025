@extends('admin.template')

@section('title', 'Tambah User')

@section('content')
<div class="container mt-5">
    <h2>Tambah User Baru</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Kontak -->
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak') }}" required>
            @error('kontak')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" name="password" id="password" class="form-control" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Status (otomatis) -->
        <input type="hidden" name="status" value="{{ old('role') == 'admin' ? 'approved' : 'pending' }}">

        <button type="submit" class="btn btn-primary">Simpan User</button>
    </form>
</div>
@endsection
