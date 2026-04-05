@extends('layouts.main')

@section('title', 'Edit User')

@section('page-icon', 'fa-user-edit')

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
                        <i class="fas fa-user-edit me-2" style="color: var(--primary-brown);"></i>
                        Edit User
                    </h5>
                    <p class="text-muted small mb-0">Perbarui data pengguna</p>
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
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="editUserForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-user me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name', $user->name) }}" 
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
                                       value="{{ old('email', $user->email) }}" 
                                       placeholder="Masukkan email"
                                       required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-lock me-1"></i>Password Baru
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" 
                                           placeholder="Kosongkan jika tidak ingin mengubah">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: #e9ecef;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted d-block mt-1">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Minimal 8 karakter, mengandung huruf besar, kecil, dan angka
                                </small>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-lock me-1"></i>Konfirmasi Password Baru
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Ulangi password baru">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label small fw-medium text-muted mb-2">
                                    <i class="fas fa-tag me-1"></i>Role <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                                </select>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-medium text-muted mb-2">Status Akun</label>
                                <div class="p-3" style="background: var(--light-brown); border-radius: 8px;">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-medium" for="is_active">Aktif</label>
                                    </div>
                                    <small class="text-muted d-block mt-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Nonaktifkan untuk menonaktifkan akses login user
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="mb-4 p-3" style="background: #f8f9fa; border-radius: 8px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted d-block">ID User:</small>
                                    <p class="fw-medium mb-2">{{ $user->id }}</p>
                                    
                                    <small class="text-muted d-block">Terdaftar pada:</small>
                                    <p class="fw-medium mb-2">{{ $user->created_at->format('d F Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Terakhir diperbarui:</small>
                                    <p class="fw-medium mb-2">{{ $user->updated_at->format('d F Y H:i') }}</p>
                                    
                                    <small class="text-muted d-block">Total Dokumen:</small>
                                    <p class="fw-medium mb-2">{{ $user->dokumens()->count() }} dokumen</p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.users.index') }}" class="btn" style="background: #e9ecef; color: #495057; padding: 10px 25px; border-radius: 8px;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn" id="submitBtn" style="background: var(--primary-brown); color: white; padding: 10px 25px; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i>Update User
                            </button>
                        </div>
                    </form>
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
    $('#editUserForm').on('submit', function() {
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
    });

    // Password match validation
    $('#password_confirmation').on('keyup', function() {
        const password = $('#password').val();
        const confirm = $(this).val();
        
        if (password !== confirm && password !== '') {
            $(this).removeClass('is-valid').addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });
});
</script>
@endpush