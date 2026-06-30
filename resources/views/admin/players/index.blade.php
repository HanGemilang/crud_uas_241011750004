@extends('layouts.admin')
@section('title', 'Kelola Atlet')
@section('page_title', 'Kelola Atlet')

@section('styles')
<!-- DataTables & Responsive CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
    /* Premium Styling for DataTables Search & Filter */
    .dataTables_wrapper .dataTables_filter {
        float: right;
        margin-bottom: 15px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #dee2e6;
        border-radius: 30px;
        padding: 6px 15px 6px 35px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 12px center;
        background-size: 14px;
        transition: 0.3s;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #0f1d3a;
        box-shadow: 0 0 0 0.2rem rgba(15, 29, 58, 0.15);
    }
    .dataTables_wrapper .dataTables_filter label {
        position: relative;
        font-size: 0px; /* Hide "Search:" label */
    }
    .animate-hover {
        transition: 0.3s;
    }
    .animate-hover:hover {
        transform: scale(1.1);
    }
</style>
@endsection

@section('content')
<div class="card card-custom border-0 shadow-sm bg-white p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold text-navy mb-0">Daftar Atlet StartingVano</h5>
        <div>
            <a href="{{ route('admin.players.pdf') }}" class="btn btn-outline-danger btn-sm px-3 py-2 fw-semibold me-2">
                <i class="bi bi-file-pdf me-1"></i> Export PDF
            </a>
            <a href="{{ route('admin.players.create') }}" class="btn btn-primary btn-sm px-3 py-2 fw-semibold" style="background-color: #0f1d3a; border: none; border-radius: 5px;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Atlet
            </a>
        </div>
    </div>
    
    <div class="table-responsive">
        <table id="players-table" class="table table-hover align-middle mb-0 display nowrap" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 80px;">Gambar</th>
                    <th>ID Atlet</th>
                    <th>Nama Atlet</th>
                    <th>Cabang Olahraga</th>
                    <th>Klub</th>
                    <th>Usia</th>
                    <th class="text-end pe-4" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $index => $player)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                             <img src="{{ asset('storage/' . $player->gambar) }}?t={{ optional($player->updated_at)->timestamp ?? time() }}" 
                                  class="rounded animate-hover" 
                                  style="width: 50px; height: 50px; object-fit: cover;" 
                                  onerror="this.src='https://placehold.co/100x100/0f1d3a/ffffff?text={{ urlencode($player->nama_pemain) }}';">
                        </td>
                        <td>
                            <span class="badge bg-navy text-white rounded" style="background-color:#0f1d3a!important;">{{ $player->id_pemain }}</span>
                        </td>
                        <td>
                            <span class="fw-bold text-navy">{{ $player->nama_pemain }}</span>
                        </td>
                        <td>{{ $player->cabang_olahraga }}</td>
                        <td>{{ $player->klub }}</td>
                        <td>{{ $player->usia }} Tahun</td>
                        <td class="text-end pe-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.players.show', $player->id) }}" class="btn btn-sm btn-outline-info border-0" title="Detail">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-sm btn-outline-primary border-0" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger border-0 delete-btn" 
                                        data-id="{{ $player->id }}" 
                                        data-name="{{ $player->nama_pemain }}"
                                        title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="delete-form" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header bg-danger text-white border-0 py-3">
                    <h5 class="modal-title fw-bold" id="deleteModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <p class="fs-5 mb-2">Apakah Anda yakin ingin menghapus data atlet?</p>
                    <h5 class="fw-bold text-navy" id="player-name-to-delete"></h5>
                    <p class="text-muted small mt-2 mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer border-0 bg-light py-3">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4 shadow-sm">Hapus Atlet</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery, DataTables, & Responsive JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables
        var table = $('#players-table').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[2, 'asc']], // Sort by ID Atlet by default
            language: {
                search: "",
                searchPlaceholder: "Cari atlet...",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ atlet",
                infoEmpty: "Menampilkan 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "<i class='bi bi-chevron-right'></i>",
                    previous: "<i class='bi bi-chevron-left'></i>"
                }
            }
        });

        // Delete Modal Handler using event delegation
        $('#players-table').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var url = '{{ route("admin.players.destroy", ":id") }}';
            url = url.replace(':id', id);
            
            $('#delete-form').attr('action', url);
            $('#player-name-to-delete').text(name);
            
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        });
    });
</script>
@endsection
