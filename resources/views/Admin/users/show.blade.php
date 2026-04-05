@extends('layouts.main')

@section('title', 'Detail User - ' . $user->name)

@section('page-icon', 'fa-user')

@section('content')
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm me-3" 
                   style="background: var(--light-brown); color: var(--primary-brown); width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        <i class="fas fa-user me-2" style="color: var(--primary-brown);"></i>
                        Detail User
                    </h5>
                    <p class="text-muted small mb-0">Informasi lengkap pengguna</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn" style="background: #cce5ff; color: #004085; padding: 8px 15px; border-radius: 8px;">
                    <i class="fas fa-edit me-2"></i>Edit User
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- User Profile -->
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Card -->
            <div class="custom-card mb-4">
                <div class="card-body text-center p-4">
                    <div class="user-avatar mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2.5rem; background: {{ $user->role == 'admin' ? '#dc3545' : '#28a745' }};">
                        {{ $user->initials }}
                    </div>
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>
                    
                    <div class="mb-3">
                        <span class="badge me-2" style="background: {{ $user->role == 'admin' ? '#dc3545' : '#28a745' }}; color: white; padding: 6px 15px; border-radius: 20px;">
                            <i class="fas {{ $user->role == 'admin' ? 'fa-crown' : 'fa-user' }} me-1"></i>
                            {{ $user->role == 'admin' ? 'Administrator' : 'User' }}
                        </span>
                        <span class="badge" style="background: {{ $user->is_active ? '#d4edda' : '#f8d7da' }}; color: {{ $user->is_active ? '#155724' : '#721c24' }}; padding: 6px 15px; border-radius: 20px;">
                            <i class="fas {{ $user->is_active ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    @if($user->id === auth()->id())
                        <div class="alert" style="background: var(--light-brown); color: var(--primary-brown); border: none;">
                            <i class="fas fa-info-circle me-2"></i>Ini adalah akun Anda
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contact Info -->
            <div class="custom-card">
                <div class="card-header" style="background: var(--light-brown); border-bottom: none; padding: 15px 20px;">
                    <h6 class="mb-0 fw-bold" style="color: var(--dark-brown);">
                        <i class="fas fa-address-card me-2" style="color: var(--primary-brown);"></i>
                        Informasi Kontak
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Email</small>
                        <p class="fw-medium mb-0">
                            <i class="fas fa-envelope me-2 text-muted"></i>{{ $user->email }}
                        </p>
                    </div>
                    
                    @if($user->phone)
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Telepon</small>
                        <p class="fw-medium mb-0">
                            <i class="fas fa-phone me-2 text-muted"></i>{{ $user->phone }}
                        </p>
                    </div>
                    @endif

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Terdaftar</small>
                        <p class="fw-medium mb-0">
                            <i class="fas fa-calendar me-2 text-muted"></i>{{ $user->created_at->format('d F Y H:i') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Terakhir Update</small>
                        <p class="fw-medium mb-0">
                            <i class="fas fa-clock me-2 text-muted"></i>{{ $user->updated_at->format('d F Y H:i') }}
                        </p>
                    </div>

                    <div>
                        <small class="text-muted d-block mb-1">Email Verifikasi</small>
                        @if($user->email_verified_at)
                            <p class="fw-medium mb-0 text-success">
                                <i class="fas fa-check-circle me-2"></i>Terverifikasi {{ $user->email_verified_at->format('d F Y') }}
                            </p>
                        @else
                            <p class="fw-medium mb-0 text-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>Belum Terverifikasi
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Statistics Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="custom-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div style="width: 45px; height: 45px; background: var(--light-brown); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                    <i class="fas fa-file" style="color: var(--primary-brown);"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0">{{ $user->dokumens_count }}</h3>
                                    <span class="text-muted small">Total Dokumen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="custom-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div style="width: 45px; height: 45px; background: #d4edda; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                    <i class="fas fa-file-pdf" style="color: #28a745;"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0">{{ $documentsByType['file'] ?? 0 }}</h3>
                                    <span class="text-muted small">File</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="custom-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div style="width: 45px; height: 45px; background: #d1ecf1; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                    <i class="fas fa-link" style="color: #17a2b8;"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0">{{ $documentsByType['link'] ?? 0 }}</h3>
                                    <span class="text-muted small">Link</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="custom-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div style="width: 45px; height: 45px; background: #fff3cd; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                    <i class="fas fa-database" style="color: #ffc107;"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0">{{ $user->formatted_storage_used }}</h3>
                                    <span class="text-muted small">Storage</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Documents -->
            <div class="custom-card">
                <div class="card-header" style="background: var(--light-brown); border-bottom: none; padding: 15px 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold" style="color: var(--dark-brown);">
                            <i class="fas fa-file-alt me-2" style="color: var(--primary-brown);"></i>
                            Dokumen Terbaru
                        </h6>
                        @if($user->dokumens_count > 10)
                            <a href="#" class="text-decoration-none small" style="color: var(--primary-brown);">
                                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body p-3">
                    @forelse($user->dokumens->take(5) as $dokumen)
                        <div class="d-flex align-items-center justify-content-between p-3 border-bottom" style="border-color: #e9ecef !important;">
                            <div class="d-flex align-items-center">
                                <div style="width: 40px; text-align: center;">
                                    @if($dokumen->jenis_upload === 'link')
                                        <i class="fas fa-link" style="color: #17a2b8;"></i>
                                    @else
                                        @php
                                            $ext = strtolower($dokumen->file_extension ?? '');
                                        @endphp
                                        @if($ext === 'pdf')
                                            <i class="fas fa-file-pdf" style="color: #dc3545;"></i>
                                        @elseif(in_array($ext, ['doc', 'docx']))
                                            <i class="fas fa-file-word" style="color: #0d6efd;"></i>
                                        @elseif(in_array($ext, ['xls', 'xlsx']))
                                            <i class="fas fa-file-excel" style="color: #198754;"></i>
                                        @elseif(in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                                            <i class="fas fa-file-image" style="color: #0dcaf0;"></i>
                                        @else
                                            <i class="fas fa-file" style="color: #6c757d;"></i>
                                        @endif
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-medium">{{ $dokumen->nama_dokumen }}</h6>
                                    <small class="text-muted">
                                        {{ $dokumen->created_at->format('d M Y') }}
                                        @if($dokumen->jenis_upload === 'file' && $dokumen->file_size_formatted)
                                            • {{ $dokumen->file_size_formatted }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div>
                                <a href="{{ $dokumen->download_url }}" class="btn btn-sm" style="background: var(--light-brown); color: var(--primary-brown); border-radius: 6px;" target="_blank">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-file-alt" style="font-size: 40px; color: #ccc;"></i>
                            <p class="text-muted mt-2 small">Belum ada dokumen</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.user-avatar {
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: white;
}
</style>
@endsection