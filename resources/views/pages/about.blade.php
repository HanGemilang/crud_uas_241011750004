@extends('layouts.app')
@section('title', 'Tentang Kami - StartingVano')
@section('content')

<style>
    .title-line { position: relative; padding-bottom: 12px; color: #0f1d3a; font-weight: 800; }
    .title-line::after { content: ''; position: absolute; bottom: 0; left: 0; width: 60px; height: 4px; background: #d1b442; border-radius: 2px; }
    .text-navy { color: #0f1d3a; }
</style>

<div class="container py-5 my-4">
    <div class="row align-items-center">
        <div class="col-lg-7 pe-lg-5 mb-5 mb-lg-0">
            <h2 class="title-line mb-4 text-uppercase">TENTANG STARTINGVANO</h2>
            
            <p class="lead text-secondary mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                StartingVano merupakan platform berbasis Laravel yang digunakan untuk mengelola serta menampilkan informasi atlet dari berbagai cabang olahraga secara modern, cepat, dan mudah dikelola melalui halaman administrator.
            </p>
        </div>

        <div class="col-lg-5 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="StartingVano Logo" class="img-fluid" style="max-height: 250px; object-fit: contain;">
        </div>
    </div>

    <!-- VISI & MISI SECTION -->
    <div class="row mt-5 pt-4">
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 bg-white" style="border-top: 4px solid #0f1d3a !important; border-radius: 12px;">
                <h4 class="fw-bold text-navy mb-3"><i class="bi bi-eye-fill text-blue me-2" style="color:#d1b442!important;"></i> VISI</h4>
                <p class="text-secondary" style="line-height: 1.8;">
                    Menjadi platform manajemen dan informasi data atlet paling terpercaya, cepat, dan profesional di Indonesia untuk berbagai cabang olahraga.
                </p>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 bg-white" style="border-top: 4px solid #d1b442 !important; border-radius: 12px;">
                <h4 class="fw-bold text-navy mb-3"><i class="bi bi-bullseye text-blue me-2" style="color:#d1b442!important;"></i> MISI</h4>
                <p class="text-secondary" style="line-height: 1.8; white-space: pre-line;">1. Menyajikan profil lengkap dan data statistik atlet secara akurat dan mudah diakses.
2. Menyediakan panel admin yang intuitif dan efisien untuk memudahkan pembaruan data atlet.
3. Mendukung promosi dan apresiasi atas prestasi atlet dari berbagai cabang olahraga.</p>
            </div>
        </div>
    </div>
</div>

@endsection