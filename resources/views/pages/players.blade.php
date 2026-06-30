@extends('layouts.app')
@section('title', 'Data Atlet - StartingVano')
@section('content')
<style>
    .card { 
        border: 1px solid #ebebeb; 
        border-radius: 12px; 
        transition: 0.3s;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }
    .player-img { 
        max-width: 100%; 
        height: 250px; 
        object-fit: cover; 
    }
    .btn-gold { 
        background-color: #d1b442; 
        color: white; 
        border-radius: 5px; 
        padding: 8px 25px; 
        font-weight: bold; 
        border: none; 
        transition: 0.3s;
    }
    .btn-gold:hover {
        background-color: #b59830;
        color: white;
    }
</style>

<div class="container py-5">
    <h2 class="text-center fw-bold mb-4" style="color: #0f1d3a;">DAFTAR ATLET STARTINGVANO</h2>
    
    <!-- SEARCH BAR -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <form action="{{ route('players') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, cabang olahraga, atau klub..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-dark px-4"><i class="bi bi-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('players') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        @forelse($players as $player)
        <div class="col-md-4">
            <div class="card h-100 bg-white">
                <img src="{{ asset('storage/' . $player->gambar) }}?t={{ optional($player->updated_at)->timestamp ?? time() }}" class="player-img w-100" alt="{{ $player->nama_pemain }}" onerror="this.src='https://placehold.co/350x250/0f1d3a/ffffff?text={{ urlencode($player->nama_pemain) }}';">
                <div class="card-body d-flex flex-column text-center">
                    <h5 class="fw-bold mb-1" style="color: #0f1d3a;">{{ $player->nama_pemain }}</h5>
                    <p class="text-muted small mb-2">ID: {{ $player->id_pemain }}</p>
                    <div class="mt-auto">
                        <span class="badge bg-secondary mb-2">{{ $player->cabang_olahraga }}</span>
                        <p class="small text-dark mb-1"><strong>Klub:</strong> {{ $player->klub }}</p>
                        <p class="small text-dark mb-3"><strong>Usia:</strong> {{ $player->usia }} Tahun</p>
                        <a href="{{ route('players.show', $player->id) }}" class="btn btn-gold w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada data atlet.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $players->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
