@extends('layouts.main')

@section('title', 'Dashboard User')

@section('page-icon', 'fa-tachometer-alt')

@section('content')
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body p-3">
            <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                <i class="fas fa-tachometer-alt me-2" style="color: var(--primary-brown);"></i>
                Dashboard User
            </h5>
            <p class="text-muted small mb-0">Selamat datang, {{ auth()->user()->name }}!</p>
        </div>
    </div>

    <!-- Quick Action Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="custom-card h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 50px; height: 50px; background: var(--light-brown); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="fas fa-cloud-upload-alt" style="color: var(--primary-brown); font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Upload Dokumen</h6>
                            <p class="text-muted small mb-2">Upload dokumen SPMI baru</p>
                            <a href="{{ route('user.upload-dokumen.create') }}" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 5px 15px; border-radius: 6px; text-decoration: none;">
                                <i class="fas fa-plus-circle me-1"></i> Upload Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="custom-card h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 50px; height: 50px; background: #d4edda; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="fas fa-file-alt" style="color: #28a745; font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Dokumen Saya</h6>
                            <p class="text-muted small mb-2">Lihat semua dokumen Anda</p>
                            <a href="{{ route('user.dokumen-saya') }}" class="btn btn-sm" style="background: #28a745; color: white; padding: 5px 15px; border-radius: 6px; text-decoration: none;">
                                <i class="fas fa-eye me-1"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="custom-card h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 50px; height: 50px; background: #cce5ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="fas fa-user-circle" style="color: #004085; font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Profile</h6>
                            <p class="text-muted small mb-2">Kelola data profile Anda</p>
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm" style="background: #004085; color: white; padding: 5px 15px; border-radius: 6px; text-decoration: none;">
                                <i class="fas fa-edit me-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        @php
            $total = auth()->user()->dokumens()->count();
            $pending = auth()->user()->dokumens()->where('status', 'pending')->count();
            $approved = auth()->user()->dokumens()->where('status', 'approved')->count();
            $rejected = auth()->user()->dokumens()->where('status', 'rejected')->count();
        @endphp
        
        <div class="col-6 col-md-3">
            <div class="custom-card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px; height: 40px; background: var(--light-brown); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                            <i class="fas fa-file-alt" style="color: var(--primary-brown);"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $total }}</h5>
                            <span class="text-muted small">Total</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="custom-card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px; height: 40px; background: #fff3cd; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                            <i class="fas fa-clock" style="color: #856404;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $pending }}</h5>
                            <span class="text-muted small">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="custom-card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px; height: 40px; background: #d4edda; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                            <i class="fas fa-check-circle" style="color: #155724;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $approved }}</h5>
                            <span class="text-muted small">Disetujui</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="custom-card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px; height: 40px; background: #f8d7da; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                            <i class="fas fa-times-circle" style="color: #721c24;"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $rejected }}</h5>
                            <span class="text-muted small">Ditolak</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Uploads -->
    <div class="custom-card">
        <div class="card-header" style="background: var(--light-brown); border-bottom: none; padding: 15px 20px;">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold" style="color: var(--dark-brown);">
                    <i class="fas fa-history me-2" style="color: var(--primary-brown);"></i>
                    Upload Terbaru
                </h6>
                @if($total > 5)
                <a href="{{ route('user.dokumen-saya') }}" class="text-decoration-none small" style="color: var(--primary-brown);">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
                @endif
            </div>
        </div>
        <div class="card-body p-3">
            @forelse(auth()->user()->dokumens()->latest()->take(5)->get() as $doc)
            <div class="d-flex align-items-center justify-content-between p-3 border-bottom" style="border-color: #e9ecef !important;">
                <div class="d-flex align-items-center">
                    <div style="width: 36px; text-align: center;">
                        <i class="fas fa-file-pdf" style="color: #dc3545;"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 fw-medium">{{ $doc->nama_dokumen }}</h6>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i> {{ $doc->created_at->format('d/m/Y') }}
                        </small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge" style="background: 
                        @if($doc->status == 'pending') #fff3cd; color: #856404;
                        @elseif($doc->status == 'approved') #d4edda; color: #155724;
                        @else #f8d7da; color: #721c24;
                        @endif padding: 6px 12px; border-radius: 20px;">
                        @if($doc->status == 'pending') Pending
                        @elseif($doc->status == 'approved') Disetujui
                        @else Ditolak
                        @endif
                    </span>
                    <a href="{{ route('user.dokumen-saya.preview', $doc->id) }}" class="btn btn-sm" style="background: var(--light-brown); color: var(--primary-brown); border-radius: 6px;">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-4">
                <i class="fas fa-folder-open" style="font-size: 40px; color: #ccc;"></i>
                <p class="text-muted mt-2">Belum ada dokumen</p>
                <a href="{{ route('user.upload-dokumen.create') }}" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 8px 20px; border-radius: 8px; text-decoration: none;">
                    <i class="fas fa-plus-circle me-2"></i>Upload Sekarang
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection