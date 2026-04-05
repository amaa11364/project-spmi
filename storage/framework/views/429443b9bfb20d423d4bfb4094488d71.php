<?php $__env->startSection('title', 'Edit Profil'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .profile-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .profile-header {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        font-weight: bold;
        margin: 0 auto 1rem;
        border: 4px solid rgba(255,255,255,0.3);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    
    .profile-body {
        padding: 2rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: var(--primary-brown);
        box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.25);
    }
    
    .form-control[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }
    
    .section-title {
        color: var(--primary-brown);
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 10px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(153, 102, 0, 0.4);
    }
    
    .btn-outline-secondary {
        border: 2px solid #6c757d;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
    }
    
    .info-badge {
        background: var(--light-brown);
        border: 1px solid rgba(153, 102, 0, 0.2);
        border-radius: 8px;
        padding: 10px 15px;
        margin-bottom: 1rem;
    }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
        .profile-header {
            padding: 1.5rem;
        }
        
        .profile-body {
            padding: 1.5rem;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 1.5rem;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-flex.justify-content-between .btn {
            width: 100%;
            text-align: center;
        }
    }
    
    @media (max-width: 576px) {
        .profile-header {
            padding: 1rem;
        }
        
        .profile-body {
            padding: 1rem;
        }
        
        .profile-avatar {
            width: 70px;
            height: 70px;
            font-size: 1.25rem;
        }
        
        .section-title {
            font-size: 1.1rem;
        }
        
        .form-control {
            padding: 10px 12px;
        }
    }
    
    /* Alert Styles */
    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f1b0b7 100%);
        color: #721c24;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold">
                    <i class="fas fa-user-edit me-2"></i>Edit Profil
                </h4>
                <p class="text-muted mb-0">Kelola informasi profil Anda</p>
            </div>
            <div>
                <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-primary">
                <?php else: ?>
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-outline-primary">
                <?php endif; ?>
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0 mt-2">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-12">
        <div class="profile-card">
            <!-- Header -->
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo e($user->getInitials()); ?>

                </div>
                <h2 class="fw-bold mb-2">Edit Profil</h2>
                <p class="mb-0 opacity-90">Ubah informasi profil Anda</p>
            </div>
            
            <!-- Body -->
            <div class="profile-body">
                <!-- Form Update Nama -->
                <form method="POST" action="<?php echo e(route('profile.update')); ?>" id="profileForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Informasi yang bisa diubah -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="section-title">Informasi yang Dapat Diubah</h4>
                        </div>
                        
                        <div class="col-12 mb-4">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo e(old('name', $user->name)); ?>" required placeholder="Masukkan nama lengkap Anda">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="form-text">
                                Nama ini akan ditampilkan di sistem dan digunakan untuk identifikasi
                            </div>
                        </div>
                    </div>

                    <!-- Informasi yang tidak bisa diubah -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="section-title">Informasi Sistem</h4>
                            <div class="info-badge">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Informasi berikut tidak dapat diubah melalui halaman ini
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?php echo e($user->email); ?>" readonly>
                            <div class="form-text">Email digunakan untuk login</div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="<?php echo e(ucfirst($user->role ?? 'User')); ?>" readonly>
                            <div class="form-text">Role ditentukan oleh administrator</div>
                        </div>

                        <?php if($user->phone): ?>
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" value="<?php echo e($user->phone); ?>" readonly>
                            <div class="form-text">Hubungi administrator untuk perubahan</div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <?php if(auth()->user()->isAdmin()): ?>
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-secondary">
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-outline-secondary">
                                <?php endif; ?>
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Info Card -->
        <div class="profile-card">
            <div class="profile-body">
                <h5 class="fw-bold text-primary mb-3">
                    <i class="fas fa-info-circle me-2"></i>Informasi Akun
                </h5>
                <div class="row">
                    <div class="col-md-6 col-12 mb-2">
                        <small class="text-muted">
                            <i class="fas fa-calendar me-2"></i>Bergabung sejak: 
                            <strong><?php echo e($user->created_at->format('d M Y')); ?></strong>
                        </small>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <small class="text-muted">
                            <i class="fas fa-clock me-2"></i>Terakhir update: 
                            <strong><?php echo e($user->updated_at->format('d M Y H:i')); ?></strong>
                        </small>
                    </div>
                    <div class="col-12 mb-2">
                        <small class="text-muted">
                            <i class="fas fa-user me-2"></i>User ID: 
                            <strong><?php echo e($user->id); ?></strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    console.log('Profile edit page loaded');
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/profile/edit.blade.php ENDPATH**/ ?>