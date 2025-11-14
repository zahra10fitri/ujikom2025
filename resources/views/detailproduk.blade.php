@extends('template')

@section('title', $produk->nama_produk)

@section('content')
@php
    // Nomor WhatsApp penjual (format internasional tanpa 0 di depan)
    $nomorWa = '6281234567890'; 

    // Pesan otomatis yang dikirim ke penjual
    $pesan = urlencode("Halo, saya tertarik dengan produk *{$produk->nama_produk}* dengan harga Rp " 
        . number_format($produk->harga, 0, ',', '.') . ". Apakah masih tersedia?");

    // URL API WhatsApp resmi
    $urlWa = "https://wa.me/{$nomorWa}?text={$pesan}";
@endphp

<div class="container my-5">
    <div class="row">
        <!-- Gambar Produk -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('storage/'.$produk->gambar) }}" 
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
