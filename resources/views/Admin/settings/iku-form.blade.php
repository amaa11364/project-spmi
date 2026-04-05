@extends('layouts.main')

@section('title', isset($iku) ? 'Edit IKU' : 'Tambah IKU')

@section('page-icon', isset($iku) ? 'fa-edit' : 'fa-plus-circle')

@section('content')
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.settings.iku.index') }}" class="btn btn-sm me-3" 
                   style="background: var(--light-brown); color: var(--primary-brown); width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        <i class="fas {{ isset($iku) ? 'fa-edit' : 'fa-plus-circle' }} me-2" style="color: var(--primary-brown);"></i>
                        {{ isset($iku) ? 'Edit IKU' : 'Tambah IKU' }}
                    </h5>
                    <p class="text-muted small mb-0">
                        {{ isset($iku) ? 'Perbarui data Indikator Kinerja Utama' : 'Tambahkan Indikator Kinerja Utama baru' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="custom-card">
                <div class="card-body p-4">
                    <form action="{{ isset($iku) ? route('admin.settings.iku.update', $iku->id) : route('admin.settings.iku.store') }}" method="POST">
                        @csrf
                        @if(isset($iku))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kode" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-tag me-1"></i>Kode IKU <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="kode" name="kode" 
                                       value="{{ old('kode', $iku->kode ?? '') }}" 
                                       placeholder="Contoh: IKU-001" required>
                                @error('kode')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-heading me-1"></i>Nama IKU <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="nama" name="nama" 
                                       value="{{ old('nama', $iku->nama ?? '') }}" 
                                       placeholder="Masukkan nama IKU" required>
                                @error('nama')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label small fw-medium text-muted mb-2">
                                <i class="fas fa-align-left me-1"></i>Deskripsi
                            </label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" 
                                      placeholder="Jelaskan deskripsi IKU...">{{ old('deskripsi', $iku->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="p-3" style="background: var(--light-brown); border-radius: 8px;">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" 
                                           style="cursor: pointer;"
                                           {{ old('status', isset($iku) ? $iku->status : true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="status" style="cursor: pointer;">
                                        Status Aktif
                                    </label>
                                </div>
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    IKU aktif akan muncul di form upload dokumen
                                </small>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.settings.iku.index') }}" class="btn" 
                               style="background: #e9ecef; color: #495057; padding: 10px 25px; border-radius: 8px;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn" 
                                    style="background: var(--primary-brown); color: white; padding: 10px 25px; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i>
                                {{ isset($iku) ? 'Update IKU' : 'Simpan IKU' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.form-control {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}
.form-control:focus {
    border-color: var(--primary-brown);
    box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.1);
}
.form-check-input:checked {
    background-color: var(--primary-brown);
    border-color: var(--primary-brown);
}
</style>
@endpush