@extends('admin.template')

@section('title', 'Edit User')

@section('content')
<div class="container mt-5">
    <h2>Edit User</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Kontak -->
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak', $user->kontak) }}" required>
            @error('kontak')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" required>
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password (optional) -->
        <div class="mb-3">
            <label for="password" class="form-label">Password <small>(kosongkan jika tidak ingin diganti)</small></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin diganti">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
