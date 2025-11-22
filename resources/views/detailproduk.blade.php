@extends('template')

@section('title', $produk->nama_produk)

@section('content')
@php
    // $nomorWa = '6285724245617';
   $nomorWa = $produk->toko->nohp;
      if(substr($nomor, 0, 1) === '0') {
        $nomor = '62' . substr($nomor, 1);
    }
   $pesan = rawurlencode("Halo, saya ingin memesan produk {$produk->nama_produk} dengan harga Rp " 
    . number_format($produk->harga, 0, ',', '.') . ". Apakah masih tersedia?");

    $urlWa = "https://api.whatsapp.com/send?phone={$nomorWa}&text={$pesan}";

@endphp

<div class="container my-5">
    <div class="row">
        <!-- Gambar Produk -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('storage/'.$produk->gambar_produk[0]->nama_gambar) }}"
                     class="card-img-top rounded"
                     alt="{{ $produk->nama_produk }}">
            </div>
        </div>

        <!-- Info Produk -->
        <div class="col-md-6">
            <h2 class="fw-bold mb-2">{{ $produk->nama_produk }}</h2>

            <p class="text-muted mb-3" style="font-size:1.2rem;">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </p>

            <!-- STOK PRODUK -->
            <p class="mb-2">
                <strong>Stok:</strong> 
                @if($produk->stok > 0)
                    {{ $produk->stok }}
                @else
                    <span class="text-danger">Habis</span>
                @endif
            </p>

            <!-- KATEGORI PRODUK -->
            <p class="mb-2">
                <strong>Kategori:</strong> 
                {{ $produk->kategori->nama_kategori ?? 'Tidak ada kategori' }}
            </p>

            <!-- TOKO PENJUAL -->
            <p class="mb-3">
                <strong>Toko:</strong>  
                {{ $produk->toko->nama_toko ?? 'Tidak ada data toko' }}
            </p>

            <p class="mb-4">
                {{ $produk->deskripsi ?? 'Deskripsi belum tersedia.' }}
            </p>

            <div class="d-flex gap-2">
                <!-- Tombol WhatsApp -->
                <a href="{{ $urlWa }}" target="_blank" class="btn btn-success flex-fill">
                    <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                </a>

                <!-- Tombol kembali -->
                <a href="{{ url('/') }}" class="btn btn-secondary flex-fill">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
