@extends('layouts.app')
@section('title', 'Detail Atlet - ' . $player->nama_pemain)
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 15px; background: white;">
                <div class="text-center mb-4">
                     <img src="{{ asset('storage/' . $player->gambar) }}?t={{ optional($player->updated_at)->timestamp ?? time() }}" class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;" alt="{{ $player->nama_pemain }}" onerror="this.src='https://placehold.co/500x400/0f1d3a/ffffff?text={{ urlencode($player->nama_pemain) }}';">
                </div>
                
                <div class="card-body p-0">
                    <h3 class="fw-bold mb-3 text-center" style="color: #0f1d3a;">{{ $player->nama_pemain }}</h3>
                    
                    <hr>
                    
                    <div class="row g-3 py-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <h6 class="fw-bold text-muted small text-uppercase mb-1">ID Atlet</h6>
                                <p class="h5 mb-0 fw-bold" style="color: #0f1d3a;">{{ $player->id_pemain }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <h6 class="fw-bold text-muted small text-uppercase mb-1">Usia</h6>
                                <p class="h5 mb-0 fw-bold" style="color: #0f1d3a;">{{ $player->usia }} Tahun</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <h6 class="fw-bold text-muted small text-uppercase mb-1">Cabang Olahraga</h6>
                                <p class="h5 mb-0 fw-bold" style="color: #0f1d3a;">{{ $player->cabang_olahraga }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <h6 class="fw-bold text-muted small text-uppercase mb-1">Klub</h6>
                                <p class="h5 mb-0 fw-bold" style="color: #0f1d3a;">{{ $player->klub }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('players') }}" class="btn btn-dark w-100 fw-bold py-2" style="border-radius: 8px;">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Atlet
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
