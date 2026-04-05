# SPMI Dokumen Error Fix - TODO

## Plan Approved - Steps to Complete:

### 1. [ ] Fix Admin/DocumentController.php
- Replace Dokumen::findOrFail($id) with safe query: Dokumen::withTrashed()->find($id)
- Add file existence check before download/preview
- Graceful error: redirect back with 'Dokumen tidak ditemukan atau telah dihapus'

### 2. [ ] Add Admin Download/Preview Routes to DokumenController
- Route::get('admin.dokumen.download/{id}', [DokumenController::class, 'download'])
- Route::get('admin.dokumen.preview/{id}', [DokumenController::class, 'preview'])
- Implement safe methods

### 3. [ ] Clear Caches
```
php artisan route:clear
php artisan config:clear  
php artisan cache:clear
php artisan view:clear
```

### 4. [ ] Test
- Visit admin/dokumen → click download/preview on existing dokumen
- Try /admin/dokumen/download/12 → should show 'Dokumen tidak ditemukan'
- Check storage/logs/laravel.log

### 5. [ ] Verify Dokumen ID 12
```
php artisan tinker
App\\Models\\Dokumen::withTrashed()->find(12)
```

**Progress: Ready to edit files**
