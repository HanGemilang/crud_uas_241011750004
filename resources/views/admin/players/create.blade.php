@extends('layouts.admin')
@section('title', 'Tambah Atlet')
@section('page_title', 'Tambah Atlet')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card card-custom border-0 shadow-sm bg-white">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold text-navy mb-0">Tambah Data Atlet Baru</h5>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                            <div>
                                <strong class="d-block mb-1">Terjadi kesalahan input:</strong>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.players.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_pemain" class="form-label text-secondary small fw-bold">ID Atlet</label>
                            <input type="text" name="id_pemain" id="id_pemain" class="form-control @error('id_pemain') is-invalid @enderror" value="{{ old('id_pemain') }}" placeholder="AT001" required>
                            @error('id_pemain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_pemain" class="form-label text-secondary small fw-bold">Nama Atlet</label>
                            <input type="text" name="nama_pemain" id="nama_pemain" class="form-control @error('nama_pemain') is-invalid @enderror" value="{{ old('nama_pemain') }}" required>
                            @error('nama_pemain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cabang_olahraga" class="form-label text-secondary small fw-bold">Cabang Olahraga</label>
                            <input type="text" name="cabang_olahraga" id="cabang_olahraga" class="form-control @error('cabang_olahraga') is-invalid @enderror" value="{{ old('cabang_olahraga') }}" placeholder="Sepak Bola, Bola Basket, Badminton, dll" required>
                            @error('cabang_olahraga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="klub" class="form-label text-secondary small fw-bold">Klub</label>
                            <input type="text" name="klub" id="klub" class="form-control @error('klub') is-invalid @enderror" value="{{ old('klub') }}" placeholder="Nama Klub atau Tim" required>
                            @error('klub')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="usia" class="form-label text-secondary small fw-bold">Usia (Tahun)</label>
                        <input type="number" name="usia" id="usia" class="form-control @error('usia') is-invalid @enderror" value="{{ old('usia') }}" min="15" max="50" required>
                        @error('usia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label text-secondary small fw-bold">Gambar Atlet</label>
                        <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg" required onchange="previewImage(this)">
                        <div class="form-text small text-muted">Format: jpeg, png, jpg. Max 2MB.</div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('admin.players.index') }}" class="btn btn-light px-4 py-2 fw-semibold">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold" style="background-color: #0f1d3a; border: none;">Simpan Atlet</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
    <!-- Image Preview Column -->
    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="card card-custom border-0 shadow-sm bg-white text-center p-4">
            <h6 class="fw-bold text-navy mb-3">Preview Gambar</h6>
            <div class="d-flex justify-content-center align-items-center bg-light border rounded p-3 mb-3" style="min-height: 200px;">
                <img id="image-preview" src="https://placehold.co/350x200/0f1d3a/ffffff?text=Pilih+Gambar" alt="Player Preview" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
            </div>
            <small class="text-muted d-block">Preview akan otomatis diperbarui setelah Anda memilih file gambar.</small>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
