@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Data Kategori</h3>

    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th width="200px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $kategori)
            <tr>
                <td>{{ $kategori->id_kategori }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>
                    <a href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
