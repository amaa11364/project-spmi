@extends('layouts.main')

@section('title', 'Detail Dokumen')

@section('page-icon', 'fa-file-alt')

@section('content')
<div class="container-fluid px-0">
    <!-- Header dengan Tombol Kembali -->
    <div class="custom-card mb-4">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.spmi.akreditasi.index') }}" class="btn btn-sm me-3" 
                       style="background: var(--light-brown); color: var(--primary-brown); width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                            <i class="fas fa-file-alt me-2" style="color: var(--primary-brown);"></i>
                            Detail Dokumen
                        </h5>
                        <p class="text-muted small mb-0">Informasi lengkap dokumen akreditasi SPMI</p>
                    </div>
                </div>
                <div>
                    @if($dokumen->status == 'pending')
                        <span class="badge" style="background: #fff3cd; color: #856404; padding: 8px 15px; border-radius: 20px;">
                            <i class="fas fa-clock me-1"></i> Menunggu Verifikasi
                        </span>
                    @elseif($dokumen->status == 'approved')
                        <span class="badge" style="background: #d4edda; color: #155724; padding: 8px 15px; border-radius: 20px;">
                            <i class="fas fa-check-circle me-1"></i> Telah Diverifikasi
                        </span>
                    @else
                        <span class="badge" style="background: #f8d7da; color: #721c24; padding: 8px 15px; border-radius: 20px;">
                            <i class="fas fa-times-circle me-1"></i> Ditolak
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-md-7">
            <!-- Informasi Dokumen -->
            <div class="custom-card mb-4">
                <div class="card-header" style="background: var(--light-brown); border-bottom: none; padding: 15px 20px;">
                    <h6 class="mb-0 fw-bold" style="color: var(--dark-brown);">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Dokumen
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block mb-1">Nama Dokumen</small>
                            <p class="fw-medium mb-0">{{ $dokumen->nama_dokumen }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block mb-1">Kategori</small>
                            <span class="badge" style="background: var(--light-brown); color: var(--primary-brown); padding: 6px 12px;">
                                {{ $dokumen->category_label }}
                            </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block mb-1">Unit Kerja</small>
                            <p class="fw-medium mb-0">{{ $dokumen->unitKerja->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block mb-1">Pengupload</small>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 30px; height: 30px; font-size: 12px; background: var(--primary-brown);">
                                    {{ strtoupper(substr($dokumen->uploader->name ?? 'U', 0, 1)) }}
                                </div>
                                <span>{{ $dokumen->uploader->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block mb-1">Tanggal Upload</small>
                            <p class="fw-medium mb-0">
                                <i class="far fa-calendar-alt me-1 text-muted"></i>
                                {{ $dokumen->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="col-12 mb-3">
                            <small class="text-muted d-block mb-1">Deskripsi</small>
                            <div class="p-3" style="background: #f8f9fa; border-radius: 8px;">
                                <p class="mb-0">{{ $dokumen->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Verifikasi (Jika sudah diverifikasi) -->
            @if($dokumen->status != 'pending')
            <div class="custom-card mb-4">
                <div class="card-header" style="background: var(--light-brown); border-bottom: none; padding: 15px 20px;">
                    <h6 class="mb-0 fw-bold" style="color: var(--dark-brown);">
                        <i class="fas fa-clipboard-check me-2"></i>
                        Informasi Verifikasi
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block mb-1">Diverifikasi oleh</small>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 30px; height: 30px; font-size: 12px; background: var(--dark-gray);">
                                    {{ strtoupper(substr($dokumen->approver->name ?? 'A', 0, 1)) }}
                                </div>
                                <span class="fw-medium">{{ $dokumen->approver->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block mb-1">Waktu Verifikasi</small>
                            <p class="fw-medium mb-0">
                                <i class="far fa-clock me-1 text-muted"></i>
                                {{ $dokumen->approved_at ? $dokumen->approved_at->format('d/m/Y H:i') : '-' }}
                            </p>
                        </div>
                        @if($dokumen->admin_note)
                        <div class="col-12">
                            <small class="text-muted d-block mb-1">Catatan Verifikasi</small>
                            <div class="p-3" style="background: #f8f9fa; border-radius: 8px; border-left: 3px solid {{ $dokumen->status == 'approved' ? '#28a745' : '#dc3545' }};">
                                <p class="mb-0">{{ $dokumen->admin_note }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-5">
            <!-- File Preview Card -->
            <div class="custom-card mb-4">
                <div class="card-header" style="background: var(--light-brown); border-bottom: none; padding: 15px 20px;">
                    <h6 class="mb-0 fw-bold" style="color: var(--dark-brown);">
                        <i class="fas fa-file-pdf me-2"></i>
                        File Dokumen
                    </h6>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <div style="width: 80px; height: 80px; background: var(--light-brown); border-radius: 16px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-file-pdf" style="font-size: 40px; color: var(--primary-brown);"></i>
                        </div>
                        <p class="mt-3 mb-1 fw-medium">{{ $dokumen->nama_dokumen }}</p>
                        <small class="text-muted">
                            <i class="far fa-file me-1"></i> 
                            {{ strtoupper($dokumen->file_extension) }} File
                        </small>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="btn" 
                           style="background: var(--primary-brown); color: white; padding: 12px; border-radius: 8px;">
                            <i class="fas fa-download me-2"></i> Download Dokumen
                        </a>
                        
                        @if($dokumen->file_extension == 'pdf')
                            <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="btn" 
                               style="background: var(--light-brown); color: var(--primary-brown); padding: 12px; border-radius: 8px;">
                                <i class="fas fa-eye me-2"></i> Preview Dokumen
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Form Verifikasi (Jika Pending) -->
            @if($dokumen->status == 'pending')
            <div class="custom-card">
                <div class="card-header" style="background: var(--light-brown); border-bottom: none; padding: 15px 20px;">
                    <h6 class="mb-0 fw-bold" style="color: var(--dark-brown);">
                        <i class="fas fa-check-double me-2"></i>
                        Verifikasi Dokumen
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.spmi.akreditasi.approve', $dokumen->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label small fw-medium text-muted mb-2">
                                <i class="fas fa-pen me-1"></i>Catatan (jika ditolak)
                            </label>
                            <textarea name="catatan" class="form-control" rows="4" 
                                      placeholder="Tambahkan catatan verifikasi..."></textarea>
                            <small class="text-muted">Catatan akan disimpan untuk referensi</small>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" name="status" value="approved" 
                                    class="btn flex-fill" 
                                    style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; font-weight: 500;"
                                    onclick="return confirm('Setujui dokumen ini?')">
                                <i class="fas fa-check-circle me-2"></i> Setujui
                            </button>
                            <button type="submit" name="status" value="rejected" 
                                    class="btn flex-fill" 
                                    style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; font-weight: 500;"
                                    onclick="return confirm('Tolak dokumen ini? Pastikan sudah mengisi catatan.')">
                                <i class="fas fa-times-circle me-2"></i> Tolak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Form styling */
.form-control {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
}
.form-control:focus {
    border-color: var(--primary-brown);
    box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.25);
}
</style>
@endsection