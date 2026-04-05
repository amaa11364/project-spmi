

<?php $__env->startSection('title', 'Dashboard User'); ?>

<?php $__env->startSection('page-icon', 'fa-tachometer-alt'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body p-3">
            <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                <i class="fas fa-tachometer-alt me-2" style="color: var(--primary-brown);"></i>
                Dashboard User
            </h5>
            <p class="text-muted small mb-0">Selamat datang, <?php echo e(auth()->user()->name); ?>!</p>
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
                            <a href="<?php echo e(route('user.upload-dokumen.create')); ?>" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 5px 15px; border-radius: 6px; text-decoration: none;">
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
                            <a href="<?php echo e(route('user.dokumen-saya')); ?>" class="btn btn-sm" style="background: #28a745; color: white; padding: 5px 15px; border-radius: 6px; text-decoration: none;">
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
                            <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-sm" style="background: #004085; color: white; padding: 5px 15px; border-radius: 6px; text-decoration: none;">
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
        <?php
            $total = auth()->user()->dokumens()->count();
            $pending = auth()->user()->dokumens()->where('status', 'pending')->count();
            $approved = auth()->user()->dokumens()->where('status', 'approved')->count();
            $rejected = auth()->user()->dokumens()->where('status', 'rejected')->count();
        ?>
        
        <div class="col-6 col-md-3">
            <div class="custom-card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px; height: 40px; background: var(--light-brown); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                            <i class="fas fa-file-alt" style="color: var(--primary-brown);"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0"><?php echo e($total); ?></h5>
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
                            <h5 class="fw-bold mb-0"><?php echo e($pending); ?></h5>
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
                            <h5 class="fw-bold mb-0"><?php echo e($approved); ?></h5>
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
                            <h5 class="fw-bold mb-0"><?php echo e($rejected); ?></h5>
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
                <?php if($total > 5): ?>
                <a href="<?php echo e(route('user.dokumen-saya')); ?>" class="text-decoration-none small" style="color: var(--primary-brown);">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body p-3">
            <?php $__empty_1 = true; $__currentLoopData = auth()->user()->dokumens()->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="d-flex align-items-center justify-content-between p-3 border-bottom" style="border-color: #e9ecef !important;">
                <div class="d-flex align-items-center">
                    <div style="width: 36px; text-align: center;">
                        <i class="fas fa-file-pdf" style="color: #dc3545;"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 fw-medium"><?php echo e($doc->nama_dokumen); ?></h6>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i> <?php echo e($doc->created_at->format('d/m/Y')); ?>

                        </small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge" style="background: 
                        <?php if($doc->status == 'pending'): ?> #fff3cd; color: #856404;
                        <?php elseif($doc->status == 'approved'): ?> #d4edda; color: #155724;
                        <?php else: ?> #f8d7da; color: #721c24;
                        <?php endif; ?> padding: 6px 12px; border-radius: 20px;">
                        <?php if($doc->status == 'pending'): ?> Pending
                        <?php elseif($doc->status == 'approved'): ?> Disetujui
                        <?php else: ?> Ditolak
                        <?php endif; ?>
                    </span>
                    <a href="<?php echo e(route('user.dokumen-saya.preview', $doc->id)); ?>" class="btn btn-sm" style="background: var(--light-brown); color: var(--primary-brown); border-radius: 6px;">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-4">
                <i class="fas fa-folder-open" style="font-size: 40px; color: #ccc;"></i>
                <p class="text-muted mt-2">Belum ada dokumen</p>
                <a href="<?php echo e(route('user.upload-dokumen.create')); ?>" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 8px 20px; border-radius: 8px; text-decoration: none;">
                    <i class="fas fa-plus-circle me-2"></i>Upload Sekarang
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/user/dashboard.blade.php ENDPATH**/ ?>