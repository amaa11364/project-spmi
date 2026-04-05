<?php $__env->startSection('title', 'Manajemen Dokumen SPMI'); ?>

<?php $__env->startSection('page-icon', 'fa-file-alt'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Custom styles for dokumen saya */
    .stat-card-custom {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        background: white;
    }
    .stat-card-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .filter-select, .search-input {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 0.95rem;
        width: 100%;
        transition: all 0.2s ease;
    }
    .filter-select:focus, .search-input:focus {
        border-color: var(--primary-brown);
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.1);
    }
    
    .tahapan-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    .tahapan-badge.penetapan { background: #cce5ff; color: #004085; }
    .tahapan-badge.pelaksanaan { background: #d4edda; color: #155724; }
    .tahapan-badge.evaluasi { background: #fff3cd; color: #856404; }
    .tahapan-badge.pengendalian { background: #f8d7da; color: #721c24; }
    .tahapan-badge.peningkatan { background: #e0d4ff; color: #5a3d8c; }
    .tahapan-badge.umum { background: #e9ecef; color: #495057; }
    
    .doc-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .doc-icon.pdf { background: #f8d7da; color: #dc3545; }
    .doc-icon.word { background: #cce5ff; color: #0d6efd; }
    .doc-icon.excel { background: #d4edda; color: #198754; }
    .doc-icon.image { background: #e0d4ff; color: #6f42c1; }
    .doc-icon.link { background: #d1ecf1; color: #0c5460; }
    
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .btn-action:active {
        transform: translateY(0);
    }
    
    /* Status badge styles */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .status-badge.pending { background: #fff3cd; color: #856404; }
    .status-badge.approved { background: #d4edda; color: #155724; }
    .status-badge.rejected { background: #f8d7da; color: #721c24; }
    
    /* Custom pagination style */
    .pagination {
        margin-bottom: 0;
        gap: 5px;
    }
    .page-link {
        border: none;
        border-radius: 8px;
        color: #495057;
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
    
    /* Responsive */
    @media (max-width: 768px) {
        .hide-mobile {
            display: none;
        }
        
        .btn-action {
            padding: 8px 12px;
        }
        
        .stat-card-custom {
            padding: 12px !important;
        }
        
        .stat-card-custom .d-flex {
            flex-direction: column;
            text-align: center;
        }
        
        .stat-card-custom .d-flex > div:first-child {
            margin-right: 0 !important;
            margin-bottom: 8px;
        }
    }
    
    @media (max-width: 576px) {
        .d-flex.gap-2 {
            gap: 4px !important;
        }
        
        .btn-action {
            padding: 6px 8px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        <i class="fas fa-file-alt me-2" style="color: var(--primary-brown);"></i>
                        Manajemen Dokumen SPMI
                    </h5>
                    <p class="text-muted small mb-0">Kelola semua dokumen SPMI Anda</p>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge hide-mobile" style="background: var(--light-brown); color: var(--primary-brown); padding: 8px 15px; border-radius: 20px;">
                    <i class="fas fa-list me-1"></i> Total: <?php echo e($dokumens->total()); ?> Dokumen
                </span>
                <a href="<?php echo e(route('user.upload-dokumen.create')); ?>" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 18px; border-radius: 8px; text-decoration: none;">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="hide-mobile">Upload Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: var(--light-brown); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-file-alt" style="color: var(--primary-brown);"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0"><?php echo e($statistics['total'] ?? 0); ?></h5>
                        <span class="text-muted small">Total Dokumen</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: #fff3cd; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-clock" style="color: #856404;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0"><?php echo e($statistics['pending'] ?? 0); ?></h5>
                        <span class="text-muted small">Pending</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: #d4edda; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-check-circle" style="color: #155724;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0"><?php echo e($statistics['approved'] ?? 0); ?></h5>
                        <span class="text-muted small">Disetujui</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card-custom p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 45px; height: 45px; background: #f8d7da; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                        <i class="fas fa-times-circle" style="color: #721c24;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0"><?php echo e($statistics['rejected'] ?? 0); ?></h5>
                        <span class="text-muted small">Ditolak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="custom-card mb-4">
        <div class="card-body p-3">
            <form method="GET" action="<?php echo e(route('user.dokumen-saya')); ?>" id="filterForm">
                <div class="row g-2">
                    <div class="col-12 col-md-4">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute" style="left: 12px; top: 12px; color: #adb5bd;"></i>
                            <input type="text" name="search" class="search-input" placeholder="Cari dokumen..." 
                                   value="<?php echo e(request('search')); ?>" style="padding-left: 35px;">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="tahapan" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Tahapan</option>
                            <option value="penetapan" <?php echo e(request('tahapan') == 'penetapan' ? 'selected' : ''); ?>>Penetapan</option>
                            <option value="pelaksanaan" <?php echo e(request('tahapan') == 'pelaksanaan' ? 'selected' : ''); ?>>Pelaksanaan</option>
                            <option value="evaluasi" <?php echo e(request('tahapan') == 'evaluasi' ? 'selected' : ''); ?>>Evaluasi</option>
                            <option value="pengendalian" <?php echo e(request('tahapan') == 'pengendalian' ? 'selected' : ''); ?>>Pengendalian</option>
                            <option value="peningkatan" <?php echo e(request('tahapan') == 'peningkatan' ? 'selected' : ''); ?>>Peningkatan</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="status" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Disetujui</option>
                            <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="sort" class="filter-select" onchange="this.form.submit()">
                            <option value="desc" <?php echo e(request('sort') == 'desc' ? 'selected' : ''); ?>>Terbaru</option>
                            <option value="asc" <?php echo e(request('sort') == 'asc' ? 'selected' : ''); ?>>Terlama</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <a href="<?php echo e(route('user.dokumen-saya')); ?>" class="btn w-100" style="background: #e9ecef; color: #495057; padding: 10px; text-decoration: none; display: inline-block; text-align: center;">
                            <i class="fas fa-sync-alt me-2"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Box untuk Dokumen Ditolak -->
    <?php if(($statistics['rejected'] ?? 0) > 0): ?>
    <div class="alert" style="background: #fff3cd; border: 1px solid #ffeeba; border-radius: 10px; color: #856404; margin-bottom: 20px;">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-triangle me-3" style="color: #856404; font-size: 20px;"></i>
            <div>
                <strong>Perhatian:</strong> Anda memiliki <strong><?php echo e($statistics['rejected']); ?></strong> dokumen yang ditolak. 
                Silakan perbaiki dokumen tersebut dengan mengklik tombol edit <i class="fas fa-edit mx-1"></i> pada dokumen dengan status "Ditolak".
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Documents Table -->
    <div class="custom-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: var(--light-brown);">
                    <tr>
                        <th class="py-3 ps-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">DOKUMEN</th>
                        <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">TAHAPAN</th>
                        <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">TANGGAL</th>
                        <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">STATUS</th>
                        <th class="py-3 pe-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $dokumens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-bottom">
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <?php
                                    $ext = strtolower($dokumen->file_extension ?? pathinfo($dokumen->file_name, PATHINFO_EXTENSION));
                                    $iconClass = 'fas fa-file-alt';
                                    $iconBg = 'doc-icon';
                                    
                                    if ($dokumen->jenis_upload == 'link') {
                                        $iconClass = 'fas fa-link';
                                        $iconBg .= ' link';
                                    } elseif ($ext == 'pdf') {
                                        $iconClass = 'fas fa-file-pdf';
                                        $iconBg .= ' pdf';
                                    } elseif (in_array($ext, ['doc', 'docx'])) {
                                        $iconClass = 'fas fa-file-word';
                                        $iconBg .= ' word';
                                    } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                        $iconClass = 'fas fa-file-excel';
                                        $iconBg .= ' excel';
                                    } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                        $iconClass = 'fas fa-file-image';
                                        $iconBg .= ' image';
                                    }
                                ?>
                                <div class="<?php echo e($iconBg); ?> me-3">
                                    <i class="<?php echo e($iconClass); ?>"></i>
                                </div>
                                <div>
                                    <span class="fw-medium"><?php echo e($dokumen->nama_dokumen); ?></span>
                                    <small class="text-muted d-block"><?php echo e($dokumen->file_name); ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="tahapan-badge <?php echo e($dokumen->tahapan ?? 'umum'); ?>">
                                <i class="fas 
                                    <?php switch($dokumen->tahapan):
                                        case ('penetapan'): ?> fa-folder-open <?php break; ?>
                                        <?php case ('pelaksanaan'): ?> fa-play-circle <?php break; ?>
                                        <?php case ('evaluasi'): ?> fa-chart-line <?php break; ?>
                                        <?php case ('pengendalian'): ?> fa-tasks <?php break; ?>
                                        <?php case ('peningkatan'): ?> fa-chart-bar <?php break; ?>
                                        <?php default: ?> fa-file
                                    <?php endswitch; ?>
                                    me-1
                                "></i>
                                <?php echo e(ucfirst($dokumen->tahapan ?? 'Umum')); ?>

                            </span>
                        </td>
                        <td>
                            <span style="font-size: 0.9rem;">
                                <i class="far fa-calendar-alt me-1 text-muted"></i>
                                <?php echo e(\Carbon\Carbon::parse($dokumen->created_at)->format('d/m/Y')); ?>

                                <br>
                                <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($dokumen->created_at)->format('H:i')); ?></small>
                            </span>
                        </td>
                        <td>
                            <div>
                                <span class="status-badge <?php echo e($dokumen->status ?? 'pending'); ?>">
                                    <i class="fas 
                                        <?php if($dokumen->status == 'pending'): ?> fa-clock
                                        <?php elseif($dokumen->status == 'approved'): ?> fa-check-circle
                                        <?php else: ?> fa-times-circle
                                        <?php endif; ?> me-1
                                    "></i>
                                    <?php if($dokumen->status == 'pending'): ?> Pending
                                    <?php elseif($dokumen->status == 'approved'): ?> Disetujui
                                    <?php else: ?> Ditolak
                                    <?php endif; ?>
                                </span>
                                
                                <?php if($dokumen->status == 'rejected' && $dokumen->admin_note): ?>
                                <div class="mt-1">
                                    <small class="text-danger" style="font-size: 0.7rem;">
                                        <i class="fas fa-info-circle me-1"></i>
                                        <?php echo e(Str::limit($dokumen->admin_note, 30)); ?>

                                    </small>
                                </div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="pe-4">
                            <div class="d-flex gap-2">
                                <!-- Tombol Lihat -->
                                <a href="<?php echo e(route('user.dokumen-saya.preview', $dokumen->id)); ?>" 
                                   class="btn-action" 
                                   style="background: var(--light-brown); color: var(--primary-brown);" 
                                   target="_blank" 
                                   title="Lihat Dokumen">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <!-- Tombol Edit - Untuk Status PENDING dan REJECTED -->
                                <?php if(in_array($dokumen->status, ['pending', 'rejected'])): ?>
                                    <a href="<?php echo e(route('user.dokumen-saya.edit', $dokumen->id)); ?>" 
                                       class="btn-action" 
                                       style="background: <?php echo e($dokumen->status == 'rejected' ? '#fff3cd' : '#cce5ff'); ?>; color: <?php echo e($dokumen->status == 'rejected' ? '#856404' : '#004085'); ?>;" 
                                       title="<?php echo e($dokumen->status == 'rejected' ? 'Perbaiki Dokumen' : 'Edit Dokumen'); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                <?php endif; ?>

                                <!-- Tombol Download -->
                                <a href="<?php echo e(route('user.dokumen-saya.download', $dokumen->id)); ?>" 
                                   class="btn-action" 
                                   style="background: #e9ecef; color: #495057;" 
                                   title="Download">
                                    <i class="fas fa-download"></i>
                                </a>

                                <!-- Tombol Hapus - Hanya untuk Status PENDING -->
                                <?php if($dokumen->status == 'pending'): ?>
                                <button type="button" 
                                        class="btn-action" 
                                        style="background: #f8d7da; color: #721c24; border: none;" 
                                        onclick="confirmDelete(<?php echo e($dokumen->id); ?>)" 
                                        title="Hapus Dokumen">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-<?php echo e($dokumen->id); ?>" 
                                      action="<?php echo e(route('user.dokumen-saya.destroy', $dokumen->id)); ?>" 
                                      method="POST" 
                                      style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-folder-open" style="font-size: 48px; color: #ccc;"></i>
                            <p class="mt-3 text-muted">Belum ada dokumen</p>
                            <?php if(request('search') || request('tahapan') || request('status')): ?>
                            <p class="text-muted small">Tidak ada dokumen yang sesuai dengan filter</p>
                            <a href="<?php echo e(route('user.dokumen-saya')); ?>" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 8px 20px; text-decoration: none;">
                                <i class="fas fa-sync-alt me-2"></i>Reset Filter
                            </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('user.upload-dokumen.create')); ?>" class="btn btn-sm" style="background: var(--primary-brown); color: white; padding: 8px 20px; text-decoration: none;">
                                <i class="fas fa-plus-circle me-2"></i>Upload Sekarang
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($dokumens->hasPages()): ?>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3 border-top">
            <div class="text-muted small mb-2 mb-md-0">
                Menampilkan <?php echo e($dokumens->firstItem() ?? 0); ?> - <?php echo e($dokumens->lastItem() ?? 0); ?> 
                dari <?php echo e($dokumens->total()); ?> dokumen
            </div>
            <div>
                <?php echo e($dokumens->appends(request()->query())->links()); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Fungsi konfirmasi hapus
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus dokumen ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // Auto submit search dengan debounce
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 500);
            });
        }

        // Highlight baris dengan status rejected
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const statusCell = row.querySelector('td:nth-child(4) .status-badge');
            if (statusCell && statusCell.classList.contains('rejected')) {
                row.style.backgroundColor = '#fff9f9';
            }
        });
    });

    // Tampilkan notifikasi dari session
    <?php if(session('success')): ?>
        alert('<?php echo e(session('success')); ?>');
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        alert('<?php echo e(session('error')); ?>');
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/user/dokumen-saya.blade.php ENDPATH**/ ?>