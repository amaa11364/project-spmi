

<?php $__env->startSection('title', 'Penetapan SPMI'); ?>

<?php $__env->startSection('page-icon', 'fa-file-signature'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-0">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div>
                <h5 class="fw-bold mb-1 p-1" style="color: var(--dark-brown);">
                    <i class="fas fa-file-signature me-2" style="color: var(--primary-brown);"></i>
                    Dokumen Penetapan SPMI
                </h5>
                <p class="text-muted small mb-0">Daftar dokumen penetapan SPMI yang telah diupload</p>
            </div>
            <div>
                <span class="badge" style="background: var(--light-brown); color: var(--primary-brown); padding: 8px 15px; border-radius: 20px;">
                    <i class="fas fa-file-pdf me-1"></i> Total: <?php echo e($dokumen->total()); ?> Dokumen
                </span>
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

    <!-- Table Card -->
    <div class="custom-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: var(--light-brown);">
                        <tr>
                            <th class="py-3 ps-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">NO</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">NAMA DOKUMEN</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">PENGUPLOAD</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">UNIT KERJA</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">TANGGAL</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">STATUS</th>
                            <th class="py-3 pe-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-bottom">
                            <td class="ps-4 fw-medium text-secondary"><?php echo e($loop->iteration); ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2" style="width: 32px; height: 32px; background: var(--light-brown); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-file-pdf" style="color: var(--primary-brown);"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium"><?php echo e($item->nama_dokumen); ?></span>
                                        <small class="text-muted d-block"><?php echo e(Str::limit($item->deskripsi ?? 'Tidak ada deskripsi', 40)); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 28px; height: 28px; font-size: 12px; background: var(--primary-brown);">
                                        <?php echo e(strtoupper(substr($item->uploader->name ?? 'U', 0, 1))); ?>

                                    </div>
                                    <span><?php echo e($item->uploader->name ?? '-'); ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #e9ecef; color: #495057; padding: 6px 10px; border-radius: 6px; font-weight: normal;">
                                    <i class="fas fa-building me-1" style="font-size: 10px;"></i>
                                    <?php echo e($item->unitKerja->nama ?? '-'); ?>

                                </span>
                            </td>
                            <td>
                                <span style="font-size: 0.9rem;">
                                    <i class="far fa-calendar-alt me-1 text-muted"></i>
                                    <?php echo e($item->created_at->format('d/m/Y')); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($item->status == 'pending'): ?>
                                    <span class="badge" style="background: #fff3cd; color: #856404; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        <i class="fas fa-clock me-1"></i> Pending
                                    </span>
                                <?php elseif($item->status == 'approved'): ?>
                                    <span class="badge" style="background: #d4edda; color: #155724; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        <i class="fas fa-check-circle me-1"></i> Approved
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background: #f8d7da; color: #721c24; padding: 6px 12px; border-radius: 20px; font-weight: 500;">
                                        <i class="fas fa-times-circle me-1"></i> Rejected
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4">
                                <a href="<?php echo e(route('admin.spmi.penetapan.show', $item->id)); ?>" 
                                   class="btn btn-sm" 
                                   style="background: var(--light-brown); color: var(--primary-brown); border-radius: 8px; padding: 6px 15px; font-weight: 500;">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div style="opacity: 0.5;">
                                    <i class="fas fa-folder-open" style="font-size: 48px; color: #ccc;"></i>
                                    <p class="mt-3 text-muted">Belum ada dokumen</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if($dokumen->hasPages()): ?>
            <div class="d-flex justify-content-between align-items-center p-3 border-top">
                <small class="text-muted">
                    Menampilkan <?php echo e($dokumen->firstItem() ?? 0); ?> - <?php echo e($dokumen->lastItem() ?? 0); ?> dari <?php echo e($dokumen->total()); ?> dokumen
                </small>
                <div>
                    <?php echo e($dokumen->links()); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
/* Custom Pagination Style */
.pagination {
    margin-bottom: 0;
    gap: 5px;
}
.page-link {
    border: none;
    border-radius: 8px;
    color: var(--dark-gray);
    padding: 8px 12px;
    font-size: 0.9rem;
}
.page-item.active .page-link {
    background: var(--primary-brown);
    color: white;
}
.page-item.disabled .page-link {
    background: #f8f9fa;
    color: #ccc;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/admin/dashboard/spmi/penetapan/index.blade.php ENDPATH**/ ?>