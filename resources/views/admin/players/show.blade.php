@extends('layouts.admin')
@section('title', 'Detail Atlet - ' . $player->nama_pemain)
@section('page_title', 'Detail Atlet')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom border-0 shadow-sm bg-white p-4">
            <div class="row align-items-center">
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    <img src="{{ asset('storage/' . $player->gambar) }}?t={{ optional($player->updated_at)->timestamp ?? time() }}" 
                         class="img-fluid rounded shadow-sm border" 
                         style="max-height: 350px; object-fit: cover;" 
                         alt="{{ $player->nama_pemain }}"
                         onerror="this.src='https://placehold.co/350x350/0f1d3a/ffffff?text={{ urlencode($player->nama_pemain) }}';">
                </div>
                <div class="col-md-7">
                    <h3 class="fw-bold mb-3 text-navy">{{ $player->nama_pemain }}</h3>
                    <hr>
                    <table class="table table-borderless">
                        <tr>
                            <td class="ps-0 py-2 text-muted fw-semibold" style="width: 40%;">ID Atlet:</td>
                            <td class="py-2"><span class="badge bg-navy text-white" style="background-color:#0f1d3a!important;">{{ $player->id_pemain }}</span></td>
                        </tr>
                        <tr>
                            <td class="ps-0 py-2 text-muted fw-semibold">Cabang Olahraga:</td>
                            <td class="py-2">{{ $player->cabang_olahraga }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 py-2 text-muted fw-semibold">Klub:</td>
                            <td class="py-2">{{ $player->klub }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 py-2 text-muted fw-semibold">Usia:</td>
                            <td class="py-2">{{ $player->usia }} Tahun</td>
                        </tr>
                        <tr>
                            <td class="ps-0 py-2 text-muted fw-semibold">Ditambahkan Pada:</td>
                            <td class="py-2"><small class="text-secondary">{{ $player->created_at ? $player->created_at->format('d M Y H:i') : '-' }}</small></td>
                        </tr>
                    </table>
                    
                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-navy text-white px-4">
                            <i class="bi bi-pencil-fill me-1"></i> Edit Data
                        </a>
                        <a href="{{ route('admin.players.index') }}" class="btn btn-light px-4 border">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
