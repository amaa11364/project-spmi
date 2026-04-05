

<?php $__env->startSection('title', 'Kelola Akun'); ?>

<?php $__env->startSection('page-icon', 'fa-users-cog'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div>
                <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                    <i class="fas fa-users-cog me-2" style="color: var(--primary-brown);"></i>
                    Kelola Akun
                </h5>
                <p class="text-muted small mb-0">Kelola semua akun pengguna dalam sistem</p>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge" style="background: var(--light-brown); color: var(--primary-brown); padding: 8px 15px; border-radius: 20px;">
                    <i class="fas fa-users me-1"></i> Total: <?php echo e($users->total()); ?> User
                </span>
                <a href="<?php echo e(route('admin.users.export.csv')); ?>" class="btn" style="background: #28a745; color: white; padding: 8px 15px; border-radius: 8px;">
                    <i class="fas fa-download me-2"></i>Export CSV
                </a>
                <a href="<?php echo e(route('admin.users.create')); ?>" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 18px; border-radius: 8px;">
                    <i class="fas fa-plus-circle me-2"></i>Tambah User
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="custom-card mb-4">
        <div class="card-body p-3">
            <form action="<?php echo e(route('admin.users.index')); ?>" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-medium text-muted mb-1">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control border-start-0 ps-0" 
                               placeholder="Cari nama atau email..."
                               value="<?php echo e(request('search')); ?>"
                               style="background: white;">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-medium text-muted mb-1">Filter Role</label>
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Administrator</option>
                        <option value="user" <?php echo e(request('role') == 'user' ? 'selected' : ''); ?>>User</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-medium text-muted mb-1">Filter Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn me-2" style="background: var(--primary-brown); color: white; padding: 8px 20px; border-radius: 8px;">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn" style="background: #e9ecef; color: #495057; padding: 8px 20px; border-radius: 8px;">
                        <i class="fas fa-sync-alt me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Users Table -->
    <div class="custom-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: var(--light-brown);">
                        <tr>
                            <th class="py-3 ps-4" width="50">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll" style="cursor: pointer;">
                                </div>
                            </th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">USER</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">EMAIL</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">ROLE</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">STATUS</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">DOKUMEN</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">TERDAFTAR</th>
                            <th class="py-3 pe-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <?php if($user->id !== auth()->id()): ?>
                                <div class="form-check">
                                    <input class="form-check-input user-checkbox" 
                                           type="checkbox" 
                                           name="user_ids[]" 
                                           value="<?php echo e($user->id); ?>"
                                           style="cursor: pointer;">
                                </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 38px; height: 38px; font-size: 14px; <?php echo e($user->id === auth()->id() ? 'background: var(--primary-brown);' : ''); ?> background: <?php echo e($user->role == 'admin' ? '#dc3545' : '#28a745'); ?>;">
                                        <?php echo e($user->initials); ?>

                                    </div>
                                    <div>
                                        <span class="fw-medium"><?php echo e($user->name); ?></span>
                                        <?php if($user->id === auth()->id()): ?>
                                            <span class="badge ms-2" style="background: var(--light-brown); color: var(--primary-brown); font-size: 10px;">Anda</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span><?php echo e($user->email); ?></span>
                            </td>
                            <td>
                                <span class="badge" style="background: <?php echo e($user->role == 'admin' ? '#dc3545' : '#28a745'); ?>; color: white; padding: 6px 12px; border-radius: 20px;">
                                    <i class="fas <?php echo e($user->role == 'admin' ? 'fa-crown' : 'fa-user'); ?> me-1"></i>
                                    <?php echo e($user->role == 'admin' ? 'Administrator' : 'User'); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-switch me-2">
                                        <input class="form-check-input toggle-status" 
                                               type="checkbox" 
                                               data-user-id="<?php echo e($user->id); ?>"
                                               <?php echo e($user->is_active ? 'checked' : ''); ?>

                                               <?php echo e($user->id === auth()->id() ? 'disabled' : ''); ?>

                                               style="cursor: pointer;">
                                    </div>
                                    <span class="small" style="color: <?php echo e($user->is_active ? '#28a745' : '#dc3545'); ?>;">
                                        <?php echo e($user->is_active ? 'Aktif' : 'Nonaktif'); ?>

                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #e9ecef; color: #495057; padding: 6px 10px;">
                                    <i class="fas fa-file me-1"></i>
                                    <?php echo e($user->dokumens_count ?? $user->dokumens->count()); ?>

                                </span>
                                <?php if(($user->dokumens_count ?? $user->dokumens->count()) > 0): ?>
                                    <small class="text-muted d-block mt-1">
                                        <?php echo e($user->formatted_storage_used ?? '0 B'); ?>

                                    </small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="font-size: 0.9rem;">
                                    <i class="far fa-calendar-alt me-1 text-muted"></i>
                                    <?php echo e($user->created_at->format('d/m/Y')); ?>

                                </span>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" 
                                       class="btn btn-sm" 
                                       style="background: var(--light-brown); color: var(--primary-brown); border-radius: 6px; padding: 5px 10px;"
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" 
                                       class="btn btn-sm" 
                                       style="background: #cce5ff; color: #004085; border-radius: 6px; padding: 5px 10px;"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php if($user->id !== auth()->id()): ?>
                                    <button type="button" 
                                            class="btn btn-sm delete-user" 
                                            data-user-id="<?php echo e($user->id); ?>"
                                            data-user-name="<?php echo e($user->name); ?>"
                                            data-dokumen-count="<?php echo e($user->dokumens_count ?? 0); ?>"
                                            style="background: #f8d7da; color: #721c24; border-radius: 6px; padding: 5px 10px; <?php echo e(($user->dokumens_count ?? 0) > 0 ? 'opacity: 0.5;' : ''); ?>"
                                            title="Hapus"
                                            <?php echo e(($user->dokumens_count ?? 0) > 0 ? 'disabled' : ''); ?>>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div style="opacity: 0.5;">
                                    <i class="fas fa-users" style="font-size: 48px; color: #ccc;"></i>
                                    <p class="mt-3 text-muted">Belum ada data user</p>
                                    <?php if(request('search') || request('role') || request('status')): ?>
                                        <p class="text-muted small">Coba reset filter atau ubah kata kunci pencarian</p>
                                        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 20px; border-radius: 8px;">
                                            <i class="fas fa-sync-alt me-2"></i>Reset Filter
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination & Bulk Actions -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">
                Menampilkan <?php echo e($users->firstItem() ?? 0); ?> - <?php echo e($users->lastItem() ?? 0); ?> 
                dari <?php echo e($users->total()); ?> data
            </span>
            
            <?php if($users->total() > 0): ?>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-sm" id="bulkDeleteBtn" 
                        style="background: #f8d7da; color: #721c24; border-radius: 6px; padding: 5px 15px;" disabled>
                    <i class="fas fa-trash-alt me-2"></i>Hapus Terpilih
                </button>
                <span class="ms-2 text-muted small" id="selectedCount">(0 terpilih)</span>
            </div>
            <?php endif; ?>
        </div>
        
        <div>
            <?php echo e($users->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px; border: none;">
            <div class="modal-header" style="background: var(--light-brown); border-bottom: none;">
                <h5 class="modal-title fw-bold" style="color: var(--dark-brown);">
                    <i class="fas fa-exclamation-triangle me-2" style="color: var(--primary-brown);"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah Anda yakin ingin menghapus user <strong id="deleteUserName" style="color: var(--primary-brown);"></strong>?</p>
                <div id="deleteWarning" class="alert d-none" style="background: #f8d7da; color: #721c24; border: none;">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span id="deleteWarningMessage"></span>
                </div>
                <p class="text-danger mb-0 small"><i class="fas fa-info-circle me-1"></i>Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                <form id="deleteForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn" style="background: #e9ecef; color: #495057; padding: 8px 20px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" id="confirmDeleteBtn" style="background: #dc3545; color: white; padding: 8px 20px;">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center p-4" style="border-radius: 10px;">
            <div class="spinner-border mb-3" style="color: var(--primary-brown);" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h6 class="fw-medium">Memproses...</h6>
        </div>
    </div>
</div>

<style>
.form-check-input:checked {
    background-color: var(--primary-brown);
    border-color: var(--primary-brown);
}
.form-select, .form-control {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 0.95rem;
}
.form-select:focus, .form-control:focus {
    border-color: var(--primary-brown);
    box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.1);
}
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
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    // Select All functionality
    $('#selectAll').change(function() {
        $('.user-checkbox:enabled').prop('checked', $(this).prop('checked'));
        updateBulkDeleteButton();
    });

    // Individual checkbox change
    $('.user-checkbox').change(function() {
        updateBulkDeleteButton();
        const totalCheckboxes = $('.user-checkbox:enabled').length;
        const checkedCheckboxes = $('.user-checkbox:enabled:checked').length;
        $('#selectAll').prop('checked', totalCheckboxes > 0 && checkedCheckboxes === totalCheckboxes);
    });

    // Update bulk delete button state
    function updateBulkDeleteButton() {
        const checkedCount = $('.user-checkbox:enabled:checked').length;
        $('#bulkDeleteBtn').prop('disabled', checkedCount === 0);
        $('#selectedCount').text('(' + checkedCount + ' terpilih)');
    }

    // Bulk delete
    $('#bulkDeleteBtn').click(function() {
        const selectedIds = $('.user-checkbox:enabled:checked').map(function() {
            return $(this).val();
        }).get();

        if (selectedIds.length === 0) return;

        if (confirm('Apakah Anda yakin ingin menghapus ' + selectedIds.length + ' user terpilih?')) {
            $('#loadingModal').modal('show');
            
            $.ajax({
                url: '<?php echo e(route("admin.users.bulk-delete")); ?>',
                method: 'POST',
                data: {
                    user_ids: selectedIds,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    $('#loadingModal').modal('hide');
                    window.location.reload();
                },
                error: function(xhr) {
                    $('#loadingModal').modal('hide');
                    alert('Terjadi kesalahan saat menghapus user. Silakan coba lagi.');
                }
            });
        }
    });

    // Toggle status
    $('.toggle-status').change(function() {
        const userId = $(this).data('user-id');
        const checkbox = $(this);
        const statusText = checkbox.closest('td').find('.small');
        const originalState = checkbox.prop('checked');

        checkbox.prop('disabled', true);

        $.ajax({
            url: '/admin/users/' + userId + '/toggle-active',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.success) {
                    statusText.text(response.is_active ? 'Aktif' : 'Nonaktif')
                             .css('color', response.is_active ? '#28a745' : '#dc3545');
                } else {
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            },
            error: function() {
                checkbox.prop('checked', originalState);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            },
            complete: function() {
                checkbox.prop('disabled', false);
            }
        });
    });

    // Delete user
    $('.delete-user').click(function() {
        const userId = $(this).data('user-id');
        const userName = $(this).data('user-name');
        const dokumenCount = $(this).data('dokumen-count');
        
        $('#deleteUserName').text(userName);
        $('#deleteForm').attr('action', '/admin/users/' + userId);
        
        if (dokumenCount > 0) {
            $('#deleteWarning').removeClass('d-none');
            $('#deleteWarningMessage').text('User ini memiliki ' + dokumenCount + ' dokumen. Hapus dokumen terlebih dahulu.');
            $('#confirmDeleteBtn').prop('disabled', true);
        } else {
            $('#deleteWarning').addClass('d-none');
            $('#confirmDeleteBtn').prop('disabled', false);
        }
        
        $('#deleteModal').modal('show');
    });

    // Reset modal when hidden
    $('#deleteModal').on('hidden.bs.modal', function() {
        $('#deleteWarning').addClass('d-none');
        $('#confirmDeleteBtn').prop('disabled', false);
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/admin/users/index.blade.php ENDPATH**/ ?>