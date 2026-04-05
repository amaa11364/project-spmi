@extends('layouts.main')

@section('title', 'Tambah User')

@section('page-icon', 'fa-user-plus')

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
                        <i class="fas fa-user-plus me-2" style="color: var(--primary-brown);"></i>
                        Tambah User Baru
                    </h5>
                    <p class="text-muted small mb-0">Tambahkan akun pengguna baru ke dalam sistem</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong class="d-block mb-2"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan:</strong>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="custom-card">
                <div class="card-body p-4">
                    <form action="{{ route('admin.users.store') }}" method="POST" id="createUserForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-user me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Masukkan email"
                                       required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-lock me-1"></i>Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" 
                                           placeholder="Min. 8 karakter"
                                           required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: #e9ecef;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted d-block mt-1">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka
                                </small>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-lock me-1"></i>Konfirmasi Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Ulangi password"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-tag me-1"></i>Role <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                </select>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-medium text-muted mb-2">Status Akun</label>
                                <div class="p-3" style="background: var(--light-brown); border-radius: 8px;">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : 'checked' }}>
                                        <label class="form-check-label fw-medium" for="is_active">Aktif</label>
                                    </div>
                                    <small class="text-muted d-block mt-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Nonaktifkan untuk menonaktifkan akses login user
                                    </small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.users.index') }}" class="btn" style="background: #e9ecef; color: #495057; padding: 10px 25px; border-radius: 8px;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn" id="submitBtn" style="background: var(--primary-brown); color: white; padding: 10px 25px; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i>Simpan User
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Guide -->
            <div class="custom-card mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: var(--dark-brown);">
                        <i class="fas fa-info-circle me-2" style="color: var(--primary-brown);"></i>
                        Panduan Password
                    </h6>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                                <span class="small">Minimal 8 karakter</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                                <span class="small">Mengandung huruf BESAR (A-Z)</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                                <span class="small">Mengandung huruf kecil (a-z)</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                                <span class="small">Mengandung angka (0-9)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}
.form-control:focus, .form-select:focus {
    border-color: var(--primary-brown);
    box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.1);
}
.form-check-input:checked {
    background-color: var(--primary-brown);
    border-color: var(--primary-brown);
}
.input-group .btn {
    border: 1px solid #e9ecef;
    background: white;
}
.input-group .btn:hover {
    background: #f8f9fa;
}
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle password visibility
    $('#togglePassword').click(function() {
        const passwordInput = $('#password');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // Disable submit button after click
    $('#createUserForm').on('submit', function() {
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
    });

    // Password strength indicator
    $('#password').on('keyup', function() {
        const password = $(this).val();
        const strength = checkPasswordStrength(password);
        
        if (strength < 4) {
            $(this).removeClass('is-valid').addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        return strength;
    }

    // Confirm password match
    $('#password_confirmation').on('keyup', function() {
        const password = $('#password').val();
        const confirm = $(this).val();
        
        if (password !== confirm) {
            $(this).removeClass('is-valid').addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });
});
</script>
@endpush