@extends('layouts.main')

@section('title', 'Manajemen Dokumen SPMI')

@section('page-icon', 'fa-file-alt')

@push('styles')
<style>
    /* Custom styles for dokumen saya */
    .stat-card-custom {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        background: white;
    }
    .stat-card-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .filter-select, .search-input {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 0.95rem;
        width: 100%;
        transition: all 0.2s ease;
    }
    .filter-select:focus, .search-input:focus {
        border-color: var(--primary-brown);
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.1);
    }
    
    .tahapan-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    .tahapan-badge.penetapan { background: #cce5ff; color: #004085; }
    .tahapan-badge.pelaksanaan { background: #d4edda; color: #155724; }
    .tahapan-badge.evaluasi { background: #fff3cd; color: #856404; }
    .tahapan-badge.pengendalian { background: #f8d7da; color: #721c24; }
    .tahapan-badge.peningkatan { background: #e0d4ff; color: #5a3d8c; }
    .tahapan-badge.umum { background: #e9ecef; color: #495057; }
    
    .doc-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .doc-icon.pdf { background: #f8d7da; color: #dc3545; }
    .doc-icon.word { background: #cce5ff; color: #0d6efd; }
    .doc-icon.excel { background: #d4edda; color: #198754; }
    .doc-icon.image { background: #e0d4ff; color: #6f42c1; }
    .doc-icon.link { background: #d1ecf1; color: #0c5460; }
    
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .btn-action:active {
        transform: translateY(0);
    }
    
    /* Status badge styles */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .status-badge.pending { background: #fff3cd; color: #856404; }
    .status-badge.approved { background: #d4edda; color: #155724; }
    .status-badge.rejected { background: #f8d7da; color: #721c24; }
    
    /* Custom pagination style */
    .pagination {
        margin-bottom: 0;
        gap: 5px;
    }
    .page-link {
        border: none;
        border-radius: 8px;
        color: #495057;
        padding: 8px 12px;
        font-size: 0.9rem;
    }
    .page-item.active .page-link {
        background: var(--primary-brown);
        color: white;
    }
    .page-item.disabled .page-link {
        background: #f8f9fa;
        color: #ccc;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hide-mobile {
            display: none;
        }
        
        .btn-action {
            padding: 8px 12px;
        }
        
        .stat-card-custom {
            padding: 12px !important;
        }
        
        .stat-card-custom .d-flex {
            flex-direction: column;
            text-align: center;
        }
        
        .stat-card-custom .d-flex > div:first-child {
            margin-right: 0 !important;
            margin-bottom: 8px;
        }
    }
    
    @media (max-width: 576px) {
        .d-flex.gap-2 {
            gap: 4px !important;
        }
        
        .btn-action {
            padding: 6px 8px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        <i class="fas fa-file-alt me-2" style="color: var(--primary-brown);"></i>
                        Manajemen Dokumen SPMI
                    </h5>
                    <p class="text-muted small mb-0">Kelola semua dokumen SPMI Anda</p>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge hide-mobile" style="background: var(--light-brown); color: var(--primary-brown); padding: 8px 15px; border-radius: 20px;">
                    <i class="fas fa-list me-1"></i> Total: {{ $dokumens->total() }} Dokumen
                </span>
                <a href="{{ route('user.upload-dokumen.create') }}" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 18px; border-radius: 8px; text-decoration: none;">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="hide-mobile">Upload Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: var(--light-brown); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-file-alt" style="color: var(--primary-brown);"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $statistics['total'] ?? 0 }}</h5>
                        <span class="text-muted small">Total Dokumen</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: #fff3cd; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-clock" style="color: #856404;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $statistics['pending'] ?? 0 }}</h5>
                        <span class="text-muted small">Pending</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: #d4edda; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-check-circle" style="color: #155724;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $statistics['approved'] ?? 0 }}</h5>
                        <span class="text-muted small">Disetujui</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: #f8d7da; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-times-circle" style="color: #721c24;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $statistics['rejected'] ?? 0 }}</h5>
                        <span class="text-muted small">Ditolak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="custom-card mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('user.dokumen-saya') }}" id="filterForm">
                <div class="row g-2">
                    <div class="col-12 col-md-4">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute" style="left: 12px; top: 12px; color: #adb5bd;"></i>
                            <input type="text" name="search" class="search-input" placeholder="Cari dokumen..." 
                                   value="{{ request('search') }}" style="padding-left: 35px;">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="tahapan" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Tahapan</option>
                            <option value="penetapan" {{ request('tahapan') == 'penetapan' ? 'selected' : '' }}>Penetapan</option>
                            <option value="pelaksanaan" {{ request('tahapan') == 'pelaksanaan' ? 'selected' : '' }}>Pelaksanaan</option>
                            <option value="evaluasi" {{ request('tahapan') == 'evaluasi' ? 'selected' : '' }}>Evaluasi</option>
                            <option value="pengendalian" {{ request('tahapan') == 'pengendalian' ? 'selected' : '' }}>Pengendalian</option>
                            <option value="peningkatan" {{ request('tahapan') == 'peningkatan' ? 'selected' : '' }}>Peningkatan</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="status" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="sort" class="filter-select" onchange="this.form.submit()">
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <a href="{{ route('user.dokumen-saya') }}" class="btn w-100" style="background: #e9ecef; color: #495057; padding: 10px; text-decoration: none; display: inline-block; text-align: center;">
                            <i class="fas fa-sync-alt me-2"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Box untuk Dokumen Ditolak -->
    @if(($statistics['rejected'] ?? 0) > 0)
    <div class="alert" style="background: #fff3cd; border: 1px solid #ffeeba; border-radius: 10px; color: #856404; margin-bottom: 20px;">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-triangle me-3" style="color: #856404; font-size: 20px;"></i>
            <div>
                <strong>Perhatian:</strong> Anda memiliki <strong>{{ $statistics['rejected'] }}</strong> dokumen yang ditolak. 
                Silakan perbaiki dokumen tersebut dengan mengklik tombol edit <i class="fas fa-edit mx-1"></i> pada dokumen dengan status "Ditolak".
            </div>
        </div>
    </div>
    @endif

    <!-- Documents Table -->
    <div class="custom-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: var(--light-brown);">
                    <tr>
                        <th class="py-3 ps-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">DOKUMEN</th>
                        <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">TAHAPAN</th>
                        <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">TANGGAL</th>
                        <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">STATUS</th>
                        <th class="py-3 pe-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumens as $dokumen)
                    <tr class="border-bottom">
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @php
                                    $ext = strtolower($dokumen->file_extension ?? pathinfo($dokumen->file_name, PATHINFO_EXTENSION));
                                    $iconClass = 'fas fa-file-alt';
                                    $iconBg = 'doc-icon';
                                    
                                    if ($dokumen->jenis_upload == 'link') {
                                        $iconClass = 'fas fa-link';
                                        $iconBg .= ' link';
                                    } elseif ($ext == 'pdf') {
                                        $iconClass = 'fas fa-file-pdf';
                                        $iconBg .= ' pdf';
                                    } elseif (in_array($ext, ['doc', 'docx'])) {
                                        $iconClass = 'fas fa-file-word';
                                        $iconBg .= ' word';
                                    } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                        $iconClass = 'fas fa-file-excel';
                                        $iconBg .= ' excel';
                                    } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                        $iconClass = 'fas fa-file-image';
                                        $iconBg .= ' image';
                                    }
                                @endphp
                                <div class="{{ $iconBg }} me-3">
                                    <i class="{{ $iconClass }}"></i>
                                </div>
                                <div>
                                    <span class="fw-medium">{{ $dokumen->nama_dokumen }}</span>
                                    <small class="text-muted d-block">{{ $dokumen->file_name }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="tahapan-badge {{ $dokumen->tahapan ?? 'umum' }}">
                                <i class="fas 
                                    @switch($dokumen->tahapan)
                                        @case('penetapan') fa-folder-open @break
                                        @case('pelaksanaan') fa-play-circle @break
                                        @case('evaluasi') fa-chart-line @break
                                        @case('pengendalian') fa-tasks @break
                                        @case('peningkatan') fa-chart-bar @break
                                        @default fa-file
                                    @endswitch
                                    me-1
                                "></i>
                                {{ ucfirst($dokumen->tahapan ?? 'Umum') }}
                            </span>
                        </td>
                        <td>
                            <span style="font-size: 0.9rem;">
                                <i class="far fa-calendar-alt me-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($dokumen->created_at)->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($dokumen->created_at)->format('H:i') }}</small>
                            </span>
                        </td>
                        <td>
                            <div>
                                <span class="status-badge {{ $dokumen->status ?? 'pending' }}">
                                    <i class="fas 
                                        @if($dokumen->status == 'pending') fa-clock
                                        @elseif($dokumen->status == 'approved') fa-check-circle
                                        @else fa-times-circle
                                        @endif me-1
                                    "></i>
                                    @if($dokumen->status == 'pending') Pending
                                    @elseif($dokumen->status == 'approved') Disetujui
                                    @else Ditolak
                                    @endif
                                </span>
                                
                                @if($dokumen->status == 'rejected' && $dokumen->admin_note)
                                <div class="mt-1">
                                    <small class="text-danger" style="font-size: 0.7rem;">
                                        <i class="fas fa-info-circle me-1"></i>
                                        {{ Str::limit($dokumen->admin_note, 30) }}
                                    </small>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="pe-4">
                            <div class="d-flex gap-2">
                                <!-- Tombol Lihat -->
                                <a href="{{ route('user.dokumen-saya.preview', $dokumen->id) }}" 
                                   class="btn-action" 
                                   style="background: var(--light-brown); color: var(--primary-brown);" 
                                   target="_blank" 
                                   title="Lihat Dokumen">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <!-- Tombol Edit - Untuk Status PENDING dan REJECTED -->
                                @if(in_array($dokumen->status, ['pending', 'rejected']))
                                    <a href="{{ route('user.dokumen-saya.edit', $dokumen->id) }}" 
                                       class="btn-action" 
                                       style="background: {{ $dokumen->status == 'rejected' ? '#fff3cd' : '#cce5ff' }}; color: {{ $dokumen->status == 'rejected' ? '#856404' : '#004085' }};" 
                                       title="{{ $dokumen->status == 'rejected' ? 'Perbaiki Dokumen' : 'Edit Dokumen' }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <!-- Tombol Download -->
                                <a href="{{ route('user.dokumen-saya.download', $dokumen->id) }}" 
                                   class="btn-action" 
                                   style="background: #e9ecef; color: #495057;" 
                                   title="Download">
                                    <i class="fas fa-download"></i>
                                </a>

                                <!-- Tombol Hapus - Hanya untuk Status PENDING -->
                                @if($dokumen->status == 'pending')
                                <button type="button" 
                                        class="btn-action" 
                                        style="background: #f8d7da; color: #721c24; border: none;" 
                                        onclick="confirmDelete({{ $dokumen->id }})" 
                                        title="Hapus Dokumen">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $dokumen->id }}" 
                                      action="{{ route('user.dokumen-saya.destroy', $dokumen->id) }}" 
                                      method="POST" 
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-folder-open" style="font-size: 48px; color: #ccc;"></i>
                            <p class="mt-3 text-muted">Belum ada dokumen</p>
                            @if(request('search') || request('tahapan') || request('status'))
                            <p class="text-muted small">Tidak ada dokumen yang sesuai dengan filter</p>
                            <a href="{{ route('user.dokumen-saya') }}" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 8px 20px; text-decoration: none;">
                                <i class="fas fa-sync-alt me-2"></i>Reset Filter
                            </a>
                            @else
                            <a href="{{ route('user.upload-dokumen.create') }}" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 8px 20px; text-decoration: none;">
                                <i class="fas fa-plus-circle me-2"></i>Upload Sekarang
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($dokumens->hasPages())
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3 border-top">
            <div class="text-muted small mb-2 mb-md-0">
                Menampilkan {{ $dokumens->firstItem() ?? 0 }} - {{ $dokumens->lastItem() ?? 0 }} 
                dari {{ $dokumens->total() }} dokumen
            </div>
            <div>
                {{ $dokumens->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi konfirmasi hapus
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus dokumen ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // Auto submit search dengan debounce
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 500);
            });
        }

        // Highlight baris dengan status rejected
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const statusCell = row.querySelector('td:nth-child(4) .status-badge');
            if (statusCell && statusCell.classList.contains('rejected')) {
                row.style.backgroundColor = '#fff9f9';
            }
        });
    });

    // Tampilkan notifikasi dari session
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif
    
    @if(session('error'))
        alert('{{ session('error') }}');
    @endif
</script>
@endpush