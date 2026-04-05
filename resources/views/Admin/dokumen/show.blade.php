@extends('layouts.main')

@section('title', 'Detail Dokumen')

@push('styles')
<style>
    :root {
        --primary: #8B5A2B;
        --primary-light: #D9B382;
        --primary-dark: #5A3A1C;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
    }

    .detail-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .card {
        background: white;
        border-radius: 20px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        background: white;
    }

    .card-body {
        padding: 1.5rem;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-pending {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fcd34d;
    }

    .badge-approved {
        background: #f0fdf4;
        color: #047857;
        border: 1px solid #6ee7b7;
    }

    .badge-rejected {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fca5a5;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .info-item {
        padding: 0.75rem;
        background: #f8fafc;
        border-radius: 12px;
    }

    .info-label {
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
    }

    .preview-container {
        background: #f8fafc;
        border-radius: 16px;
        padding: 1rem;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 16px;
    }

    .user-avatar-large {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 600;
        color: white;
        background: var(--primary);
        flex-shrink: 0;
    }

    .btn-action {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 500;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .btn-success {
        background: var(--success);
        color: white;
    }

    .btn-danger {
        background: var(--danger);
        color: white;
    }

    .btn-outline {
        background: white;
        border: 1px solid #e2e8f0;
        color: #64748b;
    }

    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .divider {
        height: 1px;
        background: #f0f0f0;
        margin: 1.5rem 0;
    }

    .meta-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .meta-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px dashed #f0f0f0;
    }

    .meta-item:last-child {
        border-bottom: none;
    }

    .meta-label {
        color: #64748b;
        font-size: 0.875rem;
    }

    .meta-value {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4 detail-container">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: var(--primary-dark);">
                <i class="fas fa-file-alt me-2" style="color: var(--primary);"></i>
                Detail Dokumen
            </h4>
            <p class="text-muted">Informasi lengkap dokumen SPMI</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.dokumen.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-semibold mb-1" style="color: #1e293b;">{{ $dokumen->nama_dokumen }}</h5>
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge badge-category" style="background: #f1f5f9; color: #475569;">
                                <i class="fas fa-{{ $dokumen->getIconAttribute() }} me-1"></i>
                                {{ $dokumen->category_label ?? ucfirst($dokumen->category) }}
                            </span>
                            <small class="text-muted">
                                <i class="far fa-calendar me-1"></i>{{ $dokumen->created_at->format('d F Y') }}
                            </small>
                        </div>
                    </div>
                    {!! $dokumen->status_badge !!}
                </div>
                <div class="card-body">
                    <!-- File Preview -->
                    <div class="preview-container mb-4">
                        @php
                            $extension = pathinfo($dokumen->file_path, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('storage/' . $dokumen->file_path) }}" 
                                 alt="Preview" class="img-fluid" style="max-height: 500px; border-radius: 12px;">
                        @elseif(strtolower($extension) == 'pdf')
                            <iframe src="{{ asset('storage/' . $dokumen->file_path) }}" 
                                    style="width: 100%; height: 500px; border-radius: 12px;" frameborder="0"></iframe>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-file-alt" style="font-size: 80px; color: #cbd5e1;"></i>
                                <p class="mt-3 text-muted">File tidak dapat dipratinjau</p>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($dokumen->deskripsi)
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-2" style="color: #1e293b;">Deskripsi</h6>
                        <p class="text-muted mb-0">{{ $dokumen->deskripsi }}</p>
                    </div>
                    @endif

                    <!-- Admin Notes -->
                    @if($dokumen->admin_note)
                    <div class="mb-4 p-3" style="background: #fef9f0; border-radius: 12px; border-left: 4px solid var(--primary);">
                        <h6 class="fw-semibold mb-2" style="color: var(--primary-dark);">
                            <i class="fas fa-sticky-note me-2"></i>Catatan Admin
                        </h6>
                        <p class="mb-0" style="color: #5A3A1C;">{{ $dokumen->admin_note }}</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.dokumen.download', $dokumen->id) }}" class="btn-action btn-primary">
                            <i class="fas fa-download"></i>
                            Download File
                        </a>
                        
                        @if($dokumen->status != 'approved')
                        <button type="button" class="btn-action btn-success" onclick="updateStatus({{ $dokumen->id }}, 'approved')">
                            <i class="fas fa-check"></i>
                            Setujui
                        </button>
                        @endif
                        
                        @if($dokumen->status != 'rejected')
                        <button type="button" class="btn-action btn-danger" onclick="updateStatus({{ $dokumen->id }}, 'rejected')">
                            <i class="fas fa-times"></i>
                            Tolak
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Uploader Info -->
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    <h6 class="fw-semibold mb-0" style="color: #1e293b;">
                        <i class="fas fa-user me-2" style="color: var(--primary);"></i>
                        Informasi Pengupload
                    </h6>
                </div>
                <div class="card-body">
                    @php
                        $uploader = $dokumen->uploader;
                        $colors = ['#8B5A2B', '#9B6A3B', '#AB7A4B', '#BB8A5B'];
                        $colorIndex = $uploader ? ($uploader->id % count($colors)) : 0;
                    @endphp
                    
                    @if($uploader)
                    <div class="user-profile mb-4">
                        <div class="user-avatar-large " style="background: {{ $colors[$colorIndex] }};">
                            {{ $uploader->initials }}
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1" style="color: #1e293b;">{{ $uploader->name }}</h6>
                            <p class="text-muted small mb-0">{{ $uploader->email }}</p>
                            <span class="badge bg-{{ $uploader->status_class }} mt-2">{{ $uploader->status_label }}</span>
                        </div>
                    </div>
                    
                    <div class="meta-list">
                        <div class="meta-item">
                            <span class="meta-label">Unit Kerja</span>
                            <span class="meta-value">{{ $dokumen->unitKerja->nama ?? '-' }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Total Dokumen</span>
                            <span class="meta-value">{{ $uploader->dokumens()->count() }} dokumen</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Member Sejak</span>
                            <span class="meta-value">{{ $uploader->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    @else
                    <p class="text-muted text-center py-3">Data pengupload tidak ditemukan</p>
                    @endif
                </div>
            </div>

            <!-- File Info -->
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0" style="color: #1e293b;">
                        <i class="fas fa-info-circle me-2" style="color: var(--primary);"></i>
                        Informasi File
                    </h6>
                </div>
                <div class="card-body">
                    <div class="meta-list">
                        <div class="meta-item">
                            <span class="meta-label">Nama File</span>
                            <span class="meta-value">{{ $dokumen->file_name ?? basename($dokumen->file_path) }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Ukuran File</span>
                            <span class="meta-value">{{ $dokumen->file_size_formatted }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Tipe File</span>
                            <span class="meta-value">{{ strtoupper($dokumen->file_extension ?? pathinfo($dokumen->file_path, PATHINFO_EXTENSION)) }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Kategori</span>
                            <span class="meta-value">{{ $dokumen->category_label ?? ucfirst($dokumen->category) }}</span>
                        </div>
                        
                        @if($dokumen->approved_at)
                        <div class="divider"></div>
                        <div class="meta-item">
                            <span class="meta-label">Disetujui Pada</span>
                            <span class="meta-value">{{ $dokumen->approved_at->format('d F Y H:i') }}</span>
                        </div>
                        @if($dokumen->approver)
                        <div class="meta-item">
                            <span class="meta-label">Disetujui Oleh</span>
                            <span class="meta-value">{{ $dokumen->approver->name }}</span>
                        </div>
                        @endif
                        @endif
                        
                        <div class="divider"></div>
                        <div class="meta-item">
                            <span class="meta-label">Dibuat Pada</span>
                            <span class="meta-value">{{ $dokumen->created_at->format('d F Y H:i') }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Terakhir Diupdate</span>
                            <span class="meta-value">{{ $dokumen->updated_at->format('d F Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <form id="updateStatusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 1.5rem;">
                    <h5 class="modal-title fw-semibold" style="color: #1e293b;">Update Status Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <input type="hidden" name="status" id="modalStatus">
                    <div class="mb-3">
                        <label class="form-label" style="color: #475569; font-weight: 500;">Catatan <span class="text-muted">(opsional)</span></label>
                        <textarea name="catatan" class="form-control" rows="4" 
                                  placeholder="Tambahkan catatan untuk user..."
                                  style="border-radius: 12px; border: 1px solid #e2e8f0; padding: 0.75rem; resize: none;"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f0f0f0; padding: 1.5rem;">
                    <button type="button" class="btn" style="background: #f1f5f9; color: #475569; border-radius: 12px; padding: 0.6rem 1.5rem;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" style="background: var(--primary); color: white; border-radius: 12px; padding: 0.6rem 1.5rem;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateStatus(id, status) {
    const modal = new bootstrap.Modal(document.getElementById('updateStatusModal'));
    const form = document.getElementById('updateStatusForm');
    form.action = `{{ url('admin/dokumen') }}/${id}/status`;
    document.getElementById('modalStatus').value = status;
    modal.show();
}
</script>
@endpush