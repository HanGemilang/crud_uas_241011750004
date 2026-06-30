@extends('layouts.admin')
@section('title', 'Dashboard StartingVano')
@section('page_title', 'Dashboard StartingVano')

@section('content')
<!-- WELCOME CARD -->
<div class="p-4 mb-4 bg-navy text-white rounded-3 shadow-sm position-relative overflow-hidden">
    <div class="row align-items-center position-relative" style="z-index: 2;">
        <div class="col-md-8">
            <h2 class="fw-bold mb-2">Selamat Datang, {{ session('user_name') }}!</h2>
            <p class="mb-0 text-white-50">Ini adalah panel admin StartingVano. Di sini Anda dapat memantau dan mengelola data atlet olahraga secara real-time.</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <i class="bi bi-shield-check display-1 text-blue" style="opacity: 0.6;"></i>
        </div>
    </div>
    <!-- Decorative background blob -->
    <div class="position-absolute" style="right: -50px; bottom: -50px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(209,180,66,0.15) 0%, rgba(255,255,255,0) 70%);"></div>
</div>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    
    <!-- TOTAL PLAYERS STAT -->
    <div class="col-md-4">
        <div class="card stat-card h-100 bg-white shadow-sm border-0" style="border-top: 4px solid #0f1d3a !important;">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Atlet</span>
                    <h2 class="fw-bold text-navy mt-1 mb-0">{{ \App\Models\Player::count() }}</h2>
                </div>
                <div class="stat-icon bg-blue text-white" style="width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- TOTAL CLUBS STAT -->
    <div class="col-md-4">
        <div class="card stat-card h-100 bg-white shadow-sm border-0" style="border-top: 4px solid #d1b442 !important;">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Klub</span>
                    <h2 class="fw-bold text-navy mt-1 mb-0">{{ \App\Models\Player::distinct('klub')->count('klub') }}</h2>
                </div>
                <div class="stat-icon bg-navy text-white" style="width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background-color:#0f1d3a!important;">
                    <i class="bi bi-building"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- TOTAL BRANCHES STAT -->
    <div class="col-md-4">
        <div class="card stat-card h-100 bg-white shadow-sm border-0" style="border-top: 4px solid #28a745 !important;">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Cabang Olahraga</span>
                    <h2 class="fw-bold text-navy mt-1 mb-0">{{ \App\Models\Player::distinct('cabang_olahraga')->count('cabang_olahraga') }}</h2>
                </div>
                <div class="stat-icon text-white" style="width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background-color: #28a745 !important;">
                    <i class="bi bi-trophy-fill"></i>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- RECENT DATA SECTION -->
<div class="row g-4">
    
    <!-- 5 Atlet Terbaru -->
    <div class="col-12">
        <div class="card card-custom border-0 shadow-sm bg-white">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-navy"><i class="bi bi-people me-1"></i> 5 Atlet Terbaru</h6>
                <a href="{{ route('admin.players.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1" style="font-size: 0.75rem;">Kelola Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 80px;">Foto</th>
                                <th>Nama Atlet</th>
                                <th>Klub</th>
                                <th>Cabang Olahraga</th>
                                <th>Usia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Player::latest()->take(5)->get() as $player)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <img src="{{ asset('storage/' . $player->gambar) }}?t={{ optional($player->updated_at)->timestamp ?? time() }}" class="rounded" style="width: 45px; height: 45px; object-fit: cover;" onerror="this.src='https://placehold.co/100x100/0f1d3a/ffffff?text={{ urlencode($player->nama_pemain) }}';">
                                    </td>
                                    <td>
                                        <span class="fw-bold text-navy">{{ $player->nama_pemain }}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary">{{ $player->klub }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark rounded-pill">{{ $player->cabang_olahraga }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $player->usia }} Tahun</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted small">Belum ada data atlet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
