@extends('layouts.main')

@section('title', 'Edit Dokumen')

@section('page-icon', 'fa-edit')

@push('styles')
<style>
    .rejection-info {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        border-left: 4px solid #721c24;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 25px;
    }
    
    .rejection-info h6 {
        color: #721c24;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .rejection-info p {
        color: #721c24;
        margin-bottom: 5px;
    }
    
    .rejection-info small {
        color: #9e2b2b;
    }
    
    .current-file-info {
        background: #f8f9fa;
        border: 1px dashed #dee2e6;
        border-radius: 8px;
        padding: 12px 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <!-- Header -->
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('user.dokumen-saya') }}" class="btn btn-sm me-3" style="background: var(--light-brown); color: var(--primary-brown); border-radius: 8px; padding: 8px 15px;">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        <i class="fas fa-edit me-2" style="color: var(--primary-brown);"></i>
                        Edit Dokumen
                    </h5>
                    <p class="text-muted small mb-0">Perbaiki dokumen yang ditolak oleh admin</p>
                </div>
            </div>

            <!-- Info Penolakan -->
            @if($dokumen->admin_note)
            <div class="rejection-info">
                <h6>
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Alasan Penolakan:
                </h6>
                <p class="mb-2">{{ $dokumen->admin_note }}</p>
                <small>
                    <i class="fas fa-clock me-1"></i>
                    Ditolak pada: {{ \Carbon\Carbon::parse($dokumen->updated_at)->format('d/m/Y H:i') }}
                </small>
            </div>
            @endif

            <!-- Form Edit -->
            <div class="custom-card">
                <div class="card-body p-4">
                    <form action="{{ route('user.dokumen-saya.update', $dokumen->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          id="editForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Informasi File Saat Ini -->
                        @if($dokumen->jenis_upload === 'file')
                        <div class="current-file-info mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    @php
                                        $ext = strtolower($dokumen->file_extension);
                                        $iconClass = 'fas fa-file-alt';
                                        $iconColor = '#6c757d';
                                        
                                        if ($ext == 'pdf') {
                                            $iconClass = 'fas fa-file-pdf';
                                            $iconColor = '#dc3545';
                                        } elseif (in_array($ext, ['doc', 'docx'])) {
                                            $iconClass = 'fas fa-file-word';
                                            $iconColor = '#0d6efd';
                                        } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                            $iconClass = 'fas fa-file-excel';
                                            $iconColor = '#198754';
                                        } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                            $iconClass = 'fas fa-file-image';
                                            $iconColor = '#6f42c1';
                                        }
                                    @endphp
                                    <div style="width: 40px; height: 40px; background: #e9ecef; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <i class="{{ $iconClass }}" style="color: {{ $iconColor }};"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium d-block">{{ $dokumen->file_name }}</span>
                                        <small class="text-muted">
                                            Ukuran: {{ round($dokumen->file_size / 1024, 2) }} KB
                                        </small>
                                    </div>
                                </div>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-info-circle me-1"></i>File saat ini
                                </span>
                            </div>
                        </div>
                        @endif

                        <!-- Nama Dokumen -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                Nama Dokumen <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_dokumen" 
                                   class="form-control @error('nama_dokumen') is-invalid @enderror" 
                                   value="{{ old('nama_dokumen', $dokumen->nama_dokumen) }}" 
                                   required>
                            @error('nama_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tahapan SPMI -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                Tahapan SPMI <span class="text-danger">*</span>
                            </label>
                            <select name="tahapan" class="form-control @error('tahapan') is-invalid @enderror" required>
                                <option value="">Pilih Tahapan</option>
                                <option value="penetapan" {{ old('tahapan', $dokumen->tahapan) == 'penetapan' ? 'selected' : '' }}>Penetapan</option>
                                <option value="pelaksanaan" {{ old('tahapan', $dokumen->tahapan) == 'pelaksanaan' ? 'selected' : '' }}>Pelaksanaan</option>
                                <option value="evaluasi" {{ old('tahapan', $dokumen->tahapan) == 'evaluasi' ? 'selected' : '' }}>Evaluasi</option>
                                <option value="pengendalian" {{ old('tahapan', $dokumen->tahapan) == 'pengendalian' ? 'selected' : '' }}>Pengendalian</option>
                                <option value="peningkatan" {{ old('tahapan', $dokumen->tahapan) == 'peningkatan' ? 'selected' : '' }}>Peningkatan</option>
                            </select>
                            @error('tahapan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Unit Kerja -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                Unit Kerja <span class="text-danger">*</span>
                            </label>
                            <select name="unit_kerja_id" class="form-control @error('unit_kerja_id') is-invalid @enderror" required>
                                <option value="">Pilih Unit Kerja</option>
                                @foreach($unitKerjas as $unit)
                                    <option value="{{ $unit->id }}" 
                                        {{ old('unit_kerja_id', $dokumen->unit_kerja_id) == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_kerja_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- IKU Terkait -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">IKU Terkait (Opsional)</label>
                            <select name="iku_id" class="form-control @error('iku_id') is-invalid @enderror">
                                <option value="">Pilih IKU (Opsional)</option>
                                @foreach($ikus as $iku)
                                    <option value="{{ $iku->id }}" 
                                        {{ old('iku_id', $dokumen->iku_id) == $iku->id ? 'selected' : '' }}>
                                        {{ $iku->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('iku_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Keterangan/Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Keterangan/Deskripsi</label>
                            <textarea name="keterangan" 
                                      class="form-control @error('keterangan') is-invalid @enderror" 
                                      rows="3">{{ old('keterangan', $dokumen->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload File Baru -->
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                Upload File Baru 
                                <small class="text-muted fw-normal">(Kosongkan jika tidak diganti)</small>
                            </label>
                            
                            @if($dokumen->jenis_upload === 'file')
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="replaceFile" name="replace_file" value="1">
                                    <label class="form-check-label" for="replaceFile">
                                        Ganti dengan file baru
                                    </label>
                                </div>
                            </div>
                            
                            <div id="fileUploadSection" style="display: none;">
                                <input type="file" 
                                       name="file_dokumen" 
                                       class="form-control @error('file_dokumen') is-invalid @enderror"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                                <small class="text-muted">
                                    Format: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG. Maks: 10MB
                                </small>
                                @error('file_dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @else
                            <input type="file" 
                                   name="file_dokumen" 
                                   class="form-control @error('file_dokumen') is-invalid @enderror"
                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                            <small class="text-muted">
                                Format: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG. Maks: 10MB
                            </small>
                            @endif
                        </div>

                        <!-- Info Penting -->
                        <div class="alert alert-info d-flex align-items-center mb-4">
                            <i class="fas fa-info-circle me-3" style="font-size: 20px;"></i>
                            <div>
                                <strong>Perhatian:</strong> Setelah mengirimkan perbaikan, dokumen akan masuk ke antrian verifikasi ulang oleh admin. Status akan berubah menjadi "Pending".
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn" style="background: var(--primary-brown); color: white; padding: 10px 25px;">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Perbaikan
                            </button>
                            <a href="{{ route('user.dokumen-saya') }}" class="btn" style="background: #e9ecef; color: #495057; padding: 10px 25px;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($dokumen->jenis_upload === 'file')
        const replaceFileCheckbox = document.getElementById('replaceFile');
        const fileUploadSection = document.getElementById('fileUploadSection');
        const fileInput = document.querySelector('input[name="file_dokumen"]');
        
        if (replaceFileCheckbox) {
            replaceFileCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    fileUploadSection.style.display = 'block';
                    fileInput.setAttribute('required', 'required');
                } else {
                    fileUploadSection.style.display = 'none';
                    fileInput.removeAttribute('required');
                    fileInput.value = '';
                }
            });
        }
        @endif

        // Confirm before submit
        const form = document.getElementById('editForm');
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengirimkan perbaikan dokumen ini?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
@endsection