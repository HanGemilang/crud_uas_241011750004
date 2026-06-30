@extends('layouts.app')
@section('title', 'Home - StartingVano')
@section('content')

<style>
    .hover-elevate { 
        transition: 0.3s; 
    }
    .hover-elevate:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 10px 20px rgba(0,0,0,0.1)!important; 
    }
    .bg-navy { 
        background-color: #0f1d3a; 
    } 
    .text-navy { 
        color: #0f1d3a; 
    } 
    .text-gold { 
        color: #d1b442; 
    }
    .btn-gold {
        background-color: #d1b442;
        color: white;
        transition: 0.3s;
    }
    .btn-gold:hover {
        background-color: #b59830;
        color: white;
    }
    .title-line { 
        position: relative; 
        padding-bottom: 15px; 
        color: #0f1d3a; 
        font-weight: bold; 
    }
    .title-line::after { 
        content:''; 
        position:absolute; 
        bottom:0; 
        left:50%; 
        transform:translateX(-50%); 
        width:50px; 
        height:4px; 
        background:#d1b442; 
        border-radius:2px; 
    }
    .player-img {
        height: 250px;
        object-fit: cover;
        border-top-left-radius: calc(0.25rem - 1px);
        border-top-right-radius: calc(0.25rem - 1px);
    }
</style>

<!-- HERO SECTION -->
<div class="container py-5 my-3">
    <div class="row align-items-center flex-column-reverse flex-lg-row">
        <div class="col-lg-6 text-center text-lg-start mt-4 mt-lg-0">
            <h1 class="display-4 fw-bold text-navy">StartingVano</h1>
            <p class="lead mt-3 text-secondary">Platform Informasi dan Manajemen Data Atlet Berbagai Cabang Olahraga.</p>
            <div class="mt-4">
                <a href="/players" class="btn btn-lg text-white bg-navy shadow-sm px-4 me-2">Lihat Data Atlet</a>
                <a href="/about" class="btn btn-lg btn-outline-dark px-4">Tentang Kami</a>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" style="max-height: 280px; object-fit: contain;">
        </div>
    </div>
</div>

<!-- STATS SECTION -->
<div class="container-fluid py-5 my-4 bg-navy">
    <div class="container">
        <h3 class="text-center text-white fw-bold mb-5" style="letter-spacing: 1px;">STATISTIK DATA</h3>
        <div class="row text-center text-white g-4">
            <div class="col-md-4">
                <div class="p-3">
                    <h2 class="display-4 fw-bold text-gold mb-0">{{ \App\Models\Player::count() }}</h2>
                    <small class="text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px;">Total Atlet</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <h2 class="display-4 fw-bold text-gold mb-0">{{ \App\Models\Player::distinct('klub')->count('klub') }}</h2>
                    <small class="text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px;">Total Klub</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <h2 class="display-4 fw-bold text-gold mb-0">{{ \App\Models\Player::distinct('cabang_olahraga')->count('cabang_olahraga') }}</h2>
                    <small class="text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px;">Total Cabang Olahraga</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ATLET TERBARU -->
<div class="container my-5 pt-3">
    <h3 class="title-line text-center mb-5">ATLET TERBARU</h3>
    <div class="row g-4 justify-content-center">
        @forelse(\App\Models\Player::latest()->take(3)->get() as $player)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 bg-white hover-elevate">
                    <img src="{{ asset('storage/' . $player->gambar) }}?t={{ optional($player->updated_at)->timestamp ?? time() }}" 
                         class="player-img w-100" 
                         alt="{{ $player->nama_pemain }}"
                         onerror="this.src='https://placehold.co/350x250/0f1d3a/ffffff?text={{ urlencode($player->nama_pemain) }}';">
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="fw-bold mb-1 text-navy">{{ $player->nama_pemain }}</h5>
                        <p class="text-muted small mb-2">Klub: {{ $player->klub }}</p>
                        <div class="mb-3">
                            <span class="badge bg-light text-dark rounded-pill">{{ $player->cabang_olahraga }}</span>
                            <span class="badge bg-light text-dark rounded-pill">{{ $player->usia }} Tahun</span>
                        </div>
                        <div class="mt-auto">
                            <a href="{{ route('players.show', $player->id) }}" class="btn btn-navy text-white w-100 rounded-pill" style="background-color: #0f1d3a;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">Belum ada data atlet tersedia.</div>
        @endforelse
    </div>
    @if(\App\Models\Player::count() > 3)
        <div class="text-center mt-5">
            <a href="/players" class="btn btn-outline-dark rounded-pill px-4">Tampilkan Semua Atlet</a>
        </div>
    @endif
</div>

<!-- TENTANG STARTINGVANO -->
<div class="container-fluid py-5 bg-light my-5">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="max-height: 200px;" alt="StartingVano Logo">
            </div>
            <div class="col-lg-7">
                <h3 class="fw-bold text-navy mb-3">Tentang StartingVano</h3>
                <p class="text-secondary leading-relaxed">StartingVano merupakan platform berbasis Laravel yang digunakan untuk mengelola serta menampilkan informasi atlet dari berbagai cabang olahraga secara modern, cepat, dan mudah dikelola melalui halaman administrator.</p>
                <p class="text-secondary leading-relaxed">Platform ini mendukung manajemen data dari berbagai cabang olahraga populer termasuk Sepak Bola, Basket, Badminton, Tenis, Voli, Renang, Atletik, MotoGP, hingga Formula 1.</p>
                <a href="/about" class="btn btn-gold text-white px-4 py-2 mt-2 rounded-pill">Selengkapnya</a>
            </div>
        </div>
    </div>
</div>

@endsection