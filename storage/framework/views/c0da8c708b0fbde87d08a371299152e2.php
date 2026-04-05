<?php $__env->startSection('title', 'Pengaturan Unit Kerja'); ?>

<?php $__env->startSection('page-icon', 'fa-building'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div>
                <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                    <i class="fas fa-building me-2" style="color: var(--primary-brown);"></i>
                    Pengaturan Unit Kerja
                </h5>
                <p class="text-muted small mb-0">Kelola data Unit Kerja</p>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge" style="background: var(--light-brown); color: var(--primary-brown); padding: 8px 15px; border-radius: 20px;">
                    <i class="fas fa-list me-1"></i> Total: <?php echo e($unitKerjas->count()); ?> Unit
                </span>
                <a href="<?php echo e(route('admin.settings.unit-kerja.create')); ?>" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 18px; border-radius: 8px;">
                    <i class="fas fa-plus me-2"></i>Tambah Unit Kerja
                </a>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?php echo e(session('error')); ?>

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
                            <th class="py-3 ps-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">KODE</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">NAMA UNIT KERJA</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">DESKRIPSI</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">STATUS</th>
                            <th class="py-3 pe-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $unitKerjas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <span class="badge" style="background: var(--primary-brown); color: white; padding: 6px 12px; border-radius: 6px;">
                                    <?php echo e($unit->kode); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2" style="width: 32px; height: 32px; background: var(--light-brown); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-building" style="color: var(--primary-brown); font-size: 14px;"></i>
                                    </div>
                                    <span class="fw-medium"><?php echo e($unit->nama); ?></span>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e(Str::limit($unit->deskripsi, 50) ?: '-'); ?></small>
                            </td>
                            <td>
                                <?php if($unit->status): ?>
                                    <span class="badge" style="background: #d4edda; color: #155724; padding: 6px 12px; border-radius: 20px;">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background: #e9ecef; color: #6c757d; padding: 6px 12px; border-radius: 20px;">
                                        <i class="fas fa-times-circle me-1"></i> Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.settings.unit-kerja.edit', $unit->id)); ?>" 
                                       class="btn btn-sm" 
                                       style="background: var(--light-brown); color: var(--primary-brown); border-radius: 6px; padding: 5px 12px;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm" 
                                            style="background: #f8d7da; color: #721c24; border-radius: 6px; padding: 5px 12px;"
                                            onclick="confirmDelete('<?php echo e(route('admin.settings.unit-kerja.destroy', $unit->id)); ?>', '<?php echo e($unit->nama); ?>')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="opacity: 0.5;">
                                    <i class="fas fa-building" style="font-size: 48px; color: #ccc;"></i>
                                    <p class="mt-3 text-muted">Belum ada Unit Kerja yang ditambahkan</p>
                                    <a href="<?php echo e(route('admin.settings.unit-kerja.create')); ?>" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 20px; border-radius: 8px;">
                                        <i class="fas fa-plus me-2"></i>Tambah Unit Kerja Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function confirmDelete(url, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus Unit Kerja "${name}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        form.innerHTML = `
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/admin/settings/unit-kerja-index.blade.php ENDPATH**/ ?>