@extends('layouts.app')
@section('title', 'Kontak Kami - StartingVano')
@section('content')
<div class="container mt-5 py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-4 h-100" style="border-top: 4px solid #0f1d3a !important;">
                <div class="card-body">
                    <h4 class="card-title fw-bold mb-3" style="color: #0f1d3a;">Informasi Kontak</h4>
                    <p class="card-text text-secondary mb-4">
                        Hubungi kantor pusat kami atau ajukan pertanyaan seputar database atlet olahraga kami. Tim administrator kami siap membantu Anda.
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-geo-alt-fill me-2" style="color:#d1b442;"></i> 
                            <strong>Alamat:</strong> Jakarta, Indonesia
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill me-2" style="color:#d1b442;"></i> 
                            <strong>Telepon:</strong> +62 21 1234 5678
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-envelope-fill me-2" style="color:#d1b442;"></i> 
                            <strong>Email:</strong> info@startingvano.com
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 bg-white p-4 h-100" style="border-top: 4px solid #d1b442 !important;">
                <div class="card-body">
                    <h4 class="card-title fw-bold mb-3" style="color: #0f1d3a;">Hubungi Administrator</h4>
                    <form action="#">
                        <div class="form-group mb-3">
                            <label for="name" class="small fw-bold text-secondary">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="small fw-bold text-secondary">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
                        </div>
                        <div class="form-group mb-3">
                            <label for="message" class="small fw-bold text-secondary">Pesan</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Masukkan pesan Anda"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 fw-bold py-2" style="background-color:#0f1d3a;">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h4 class="fw-bold mb-3" style="color: #0f1d3a;">Lokasi Kantor Pusat StartingVano</h4>
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2736733221375!2d106.80053931476916!3d-6.218559995498453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f77%3A0x577a7605d3989c9e!2sStadion%20Utama%20Gelora%20Bung%20Karno!5e0!3m2!1sid!2sid!4v1688000000000!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection