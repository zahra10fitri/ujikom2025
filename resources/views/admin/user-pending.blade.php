@extends('admin.template')

@section('title', 'Member Pending')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Daftar Member Pending</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($members->isEmpty())
        <div class="alert alert-info">Tidak ada member pending.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->kontak }}</td>
                    <td>{{ $member->username }}</td>
                    <td>{{ $member->password }}</td>
                    <td>{{ $member->role }}</td>
                    <td>
                        <form action="{{ route('admin.user.approve', $member->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui member ini?')">Approve</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
