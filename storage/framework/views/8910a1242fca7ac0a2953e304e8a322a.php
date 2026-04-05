

<?php $__env->startSection('title', 'Manajemen Dokumen'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --primary: #8B5A2B;
        --primary-light: #D9B382;
        --primary-dark: #5A3A1C;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.2s ease;
        border: 1px solid #f0f0f0;
        text-decoration: none;
        display: block;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .stat-card.active {
        border: 2px solid var(--primary);
        background: linear-gradient(135deg, #fff 0%, #fef9f0 100%);
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-total .stat-icon { background: #eff6ff; color: var(--info); }
    .stat-pending .stat-icon { background: #fffbeb; color: var(--warning); }
    .stat-approved .stat-icon { background: #f0fdf4; color: var(--success); }
    .stat-rejected .stat-icon { background: #fef2f2; color: var(--danger); }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1.2;
        color: #1e293b;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .filter-badge {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
        background: white;
        color: #475569;
    }

    .filter-badge:hover {
        background: #f8fafc;
        border-color: var(--primary);
    }

    .filter-badge.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .table-container {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #f0f0f0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        text-align: left;
        padding: 1rem 0.75rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .table td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f8fafc;
    }

    .badge {
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .badge i {
        font-size: 0.75rem;
    }

    .badge-pending {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fcd34d;
    }

    .badge-approved {
        background: #f0fdf4;
        color: #047857;
        border: 1px solid #6ee7b7;
    }

    .badge-rejected {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fca5a5;
    }

    .badge-category {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
        background: var(--primary);
        flex-shrink: 0;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        background: white;
        color: #64748b;
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-icon:hover {
        background: #f8fafc;
        border-color: var(--primary);
        color: var(--primary);
    }

    .btn-icon.primary:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .btn-icon.success:hover {
        background: var(--success);
        border-color: var(--success);
        color: white;
    }

    .btn-icon.danger:hover {
        background: var(--danger);
        border-color: var(--danger);
        color: white;
    }

    .action-group {
        display: flex;
        gap: 0.5rem;
    }

    .pagination-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 0.875rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .progress-stats {
        background: white;
        border-radius: 16px;
        padding: 1.25rem;
        border: 1px solid #f0f0f0;
        margin-bottom: 1.5rem;
    }

    .progress-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .progress-bar-bg {
        flex: 1;
        height: 8px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: var(--primary);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .table-container {
            overflow-x: auto;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: var(--primary-dark);">
                <i class="fas fa-file-alt me-2" style="color: var(--primary);"></i>
                Manajemen Dokumen
            </h4>
            <p class="text-muted">Kelola dan pantau seluruh dokumen SPMI</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'all'])); ?>" class="stat-card stat-total <?php echo e($status == 'all' ? 'active' : ''); ?>">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <span class="stat-value"><?php echo e($statistics['total']); ?></span>
            </div>
            <div class="stat-label">Total Dokumen</div>
        </a>

        <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'pending'])); ?>" class="stat-card stat-pending <?php echo e($status == 'pending' ? 'active' : ''); ?>">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <span class="stat-value"><?php echo e($statistics['pending']); ?></span>
            </div>
            <div class="stat-label">Pending</div>
        </a>

        <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'approved'])); ?>" class="stat-card stat-approved <?php echo e($status == 'approved' ? 'active' : ''); ?>">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <span class="stat-value"><?php echo e($statistics['approved']); ?></span>
            </div>
            <div class="stat-label">Disetujui</div>
        </a>

        <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'rejected'])); ?>" class="stat-card stat-rejected <?php echo e($status == 'rejected' ? 'active' : ''); ?>">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <span class="stat-value"><?php echo e($statistics['rejected']); ?></span>
            </div>
            <div class="stat-label">Ditolak</div>
        </a>
    </div>

    <!-- Progress Stats -->
    <div class="progress-stats">
        <div class="row g-4">
            <div class="col-md-6">
                <h6 class="fw-semibold mb-3" style="color: #1e293b;">
                    <i class="fas fa-chart-pie me-2" style="color: var(--primary);"></i>
                    Distribusi per Kategori
                </h6>
                <?php $__currentLoopData = $perType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="progress-item mb-3">
                    <span style="width: 100px; color: #475569; font-size: 0.875rem; text-transform: capitalize;"><?php echo e($type); ?></span>
                    <div class="progress-bar-bg">
                        <?php
                            $percentage = $statistics['total'] > 0 ? ($count / $statistics['total']) * 100 : 0;
                        ?>
                        <div class="progress-bar-fill" style="width: <?php echo e($percentage); ?>%;"></div>
                    </div>
                    <span style="min-width: 40px; color: #1e293b; font-weight: 500; font-size: 0.875rem;"><?php echo e($count); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-md-6">
                <h6 class="fw-semibold mb-3" style="color: #1e293b;">
                    <i class="fas fa-building me-2" style="color: var(--primary);"></i>
                    Top Unit Kerja
                </h6>
                <?php $__currentLoopData = $perUnitKerja->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span style="color: #475569;"><?php echo e($unit); ?></span>
                    <span class="badge" style="background: #f1f5f9; color: var(--primary); padding: 0.35rem 0.75rem;">
                        <?php echo e($count); ?> dokumen
                    </span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <span style="color: #64748b; font-weight: 500;">Filter Status:</span>
        <div class="d-flex gap-2 flex-wrap">
            <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'all'])); ?>" class="filter-badge <?php echo e($status == 'all' ? 'active' : ''); ?>">
                <i class="fas fa-list me-1"></i>Semua
            </a>
            <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'pending'])); ?>" class="filter-badge <?php echo e($status == 'pending' ? 'active' : ''); ?>">
                <i class="fas fa-clock me-1"></i>Pending
            </a>
            <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'approved'])); ?>" class="filter-badge <?php echo e($status == 'approved' ? 'active' : ''); ?>">
                <i class="fas fa-check-circle me-1"></i>Disetujui
            </a>
            <a href="<?php echo e(route('admin.dokumen.index', ['status' => 'rejected'])); ?>" class="filter-badge <?php echo e($status == 'rejected' ? 'active' : ''); ?>">
                <i class="fas fa-times-circle me-1"></i>Ditolak
            </a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <?php if($dokumens->count() > 0): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dokumen</th>
                        <th>Kategori</th>
                        <th>Pengupload</th>
                        <th>Unit Kerja</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $dokumens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $uploader = $dokumen->uploader;
                        $colors = ['#8B5A2B', '#9B6A3B', '#AB7A4B', '#BB8A5B'];
                        $colorIndex = $uploader ? ($uploader->id % count($colors)) : 0;
                    ?>
                    <tr>
                        <td style="color: #64748b;"><?php echo e($dokumens->firstItem() + $index); ?></td>
                        <td>
                            <div class="fw-semibold" style="color: #1e293b;"><?php echo e($dokumen->nama_dokumen); ?></div>
                            <?php if($dokumen->deskripsi): ?>
                            <small class="text-muted"><?php echo e(Str::limit($dokumen->deskripsi, 30)); ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge badge-category">
                                <i class="fas fa-<?php echo e($dokumen->getIconAttribute()); ?> me-1"></i>
                                <?php echo e(ucfirst($dokumen->category)); ?>

                            </span>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar" style="background: <?php echo e($colors[$colorIndex]); ?>;">
                                    <?php echo e($uploader ? $uploader->initials : 'U'); ?>

                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1e293b;"><?php echo e($uploader->name ?? 'User Terhapus'); ?></div>
                                    <small class="text-muted"><?php echo e($uploader->email ?? '-'); ?></small>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e($dokumen->unitKerja->nama ?? '-'); ?></td>
                        <td>
                            <span class="badge badge-<?php echo e($dokumen->status); ?>">
                                <i class="fas fa-<?php echo e($dokumen->status == 'pending' ? 'clock' : ($dokumen->status == 'approved' ? 'check-circle' : 'times-circle')); ?> me-1"></i>
                                <?php echo e(ucfirst($dokumen->status)); ?>

                            </span>
                        </td>
                        <td>
                            <div style="font-size: 0.875rem; color: #1e293b;"><?php echo e($dokumen->created_at->format('d/m/Y')); ?></div>
                            <small class="text-muted"><?php echo e($dokumen->created_at->format('H:i')); ?></small>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="<?php echo e(route('admin.dokumen.show', $dokumen->id)); ?>" class="btn-icon primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if($dokumen->status != 'approved'): ?>
                                <button type="button" class="btn-icon success" onclick="updateStatus(<?php echo e($dokumen->id); ?>, 'approved')" title="Setujui">
                                    <i class="fas fa-check"></i>
                                </button>
                                <?php endif; ?>
                                <?php if($dokumen->status != 'rejected'): ?>
                                <button type="button" class="btn-icon danger" onclick="updateStatus(<?php echo e($dokumen->id); ?>, 'rejected')" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-info">
            <div>
                Menampilkan <?php echo e($dokumens->firstItem()); ?> - <?php echo e($dokumens->lastItem()); ?> dari <?php echo e($dokumens->total()); ?> dokumen
            </div>
            <div>
                <?php echo e($dokumens->links()); ?>

            </div>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-folder-open"></i>
            <h6 class="mt-3 fw-semibold">Tidak Ada Dokumen</h6>
            <p class="small">Belum ada dokumen dengan status yang dipilih</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Recent Activity -->
    <?php if($recentActivities->count() > 0): ?>
    <div class="table-container mt-4">
        <h6 class="fw-semibold mb-3" style="color: #1e293b;">
            <i class="fas fa-history me-2" style="color: var(--primary);"></i>
            Aktivitas Terbaru (7 Hari)
        </h6>
        <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex align-items-center gap-3 py-2 border-bottom" style="border-color: #f0f0f0 !important;">
            <div class="user-avatar" style="background: var(--primary-light); color: var(--primary-dark);">
                <i class="fas fa-upload"></i>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong style="color: #1e293b;"><?php echo e($activity->uploader->name ?? 'User'); ?></strong> 
                        <span class="text-muted">mengupload</span>
                        <span class="fw-semibold" style="color: var(--primary);"><?php echo e($activity->nama_dokumen); ?></span>
                    </div>
                    <small class="text-muted"><?php echo e($activity->created_at->diffForHumans()); ?></small>
                </div>
                <small class="text-muted">
                    <i class="fas fa-tag me-1"></i> <?php echo e(ucfirst($activity->category)); ?>

                    <i class="fas fa-building ms-3 me-1"></i> <?php echo e($activity->unitKerja->nama ?? '-'); ?>

                </small>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <form id="updateStatusForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 1.25rem;">
                    <h5 class="modal-title fw-semibold" style="color: #1e293b;">Update Status Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding: 1.25rem;">
                    <input type="hidden" name="status" id="modalStatus">
                    <div class="mb-3">
                        <label class="form-label" style="color: #475569; font-weight: 500;">Catatan <span class="text-muted">(opsional)</span></label>
                        <textarea name="catatan" class="form-control" rows="3" 
                                  placeholder="Tambahkan catatan untuk user..."
                                  style="border-radius: 10px; border: 1px solid #e2e8f0; padding: 0.75rem;"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f0f0f0; padding: 1.25rem;">
                    <button type="button" class="btn" style="background: #f1f5f9; color: #475569; border-radius: 10px; padding: 0.5rem 1.25rem;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" style="background: var(--primary); color: white; border-radius: 10px; padding: 0.5rem 1.25rem;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function updateStatus(id, status) {
    const modal = new bootstrap.Modal(document.getElementById('updateStatusModal'));
    const form = document.getElementById('updateStatusForm');
    form.action = `<?php echo e(url('admin/dokumen')); ?>/${id}/status`;
    document.getElementById('modalStatus').value = status;
    modal.show();
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/admin/dokumen/index.blade.php ENDPATH**/ ?>