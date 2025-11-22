@extends('template')

@section('title', 'Daftar Toko')

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">Daftar Toko</h2>

    <div class="row g-4">

        @forelse ($toko as $t)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('toko.detail', $t->id) }}" class="text-decoration-none">
                    <div class="card shadow-sm border-0 rounded-3 p-3 text-center">

                        {{-- Foto / Logo Toko --}}
                        <img src="{{ asset('storage/' . $t->foto_toko) }}"
                             class="rounded-circle mb-3"
                             style="width:90px; height:90px; object-fit:cover;">

                        <h5 class="fw-bold text-dark">{{ $t->nama_toko }}</h5>

                        <p class="text-muted small">
                            {{ Str::limit($t->deskripsi, 50) }}
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">Belum ada toko.</p>
        @endforelse

    </div>
</div>

@endsection
