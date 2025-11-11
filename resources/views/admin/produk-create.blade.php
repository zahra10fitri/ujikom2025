@extends('admin.template')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Tambah Produk</h3>

    <form action="{{ route('admin.produk.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">-- pilih kategori --</option>
                @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input t
