<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\EvaluasiController;
use App\Http\Controllers\Admin\PengendalianController;
use App\Http\Controllers\Admin\AkreditasiController;
use App\Http\Controllers\Admin\PeningkatanController;
use App\Http\Controllers\Admin\PelaksanaanController;
use App\Http\Controllers\Admin\PenetapanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DokumenController;

// ==================== LANDING PAGE & PUBLIC ROUTES ====================
Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');

Route::get('/upt', function () {
    return view('upt.index');
})->name('upt.index');

Route::get('/bagian', function () {
    return view('bagian.index');
})->name('bagian.index');

Route::get('/program-studi', function () {
    return view('program-studi.index');
})->name('program-studi.index');

Route::get('/unit-kerja', function () {
    return view('unit-kerja.index');
})->name('unit-kerja.index');

Route::get('/tentang/profil', function () {
    return view('tentang.profil');
})->name('tentang.profil');

Route::get('/tentang/visi-misi', function () {
    return view('tentang.visi-misi');
})->name('tentang.visi-misi');

Route::get('/tentang/struktur-organisasi', function () {
    return view('tentang.sotk');
})->name('tentang.sotk');

// ==================== AUTHENTICATION ROUTES ====================
Route::get('/masuk', [AuthController::class, 'showLoginForm'])->name('masuk');
Route::post('/masuk', [AuthController::class, 'masuk'])->name('masuk.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== UPLOAD DOKUMEN DENGAN KONTEKS ====================
Route::middleware(['auth'])->prefix('upload')->group(function () {
    Route::get('/spmi/penetapan/{id}', [UploadController::class, 'createWithContext'])
        ->name('upload.spmi-penetapan');
    
    Route::get('/spmi/pelaksanaan', [UploadController::class, 'createWithContext'])
        ->name('upload.spmi-pelaksanaan');
    
    Route::get('/spmi/evaluasi', [UploadController::class, 'createWithContext'])
        ->name('upload.spmi-evaluasi');
    
    Route::get('/spmi/pengendalian', [UploadController::class, 'createWithContext'])
        ->name('upload.spmi-pengendalian');
    
    Route::get('/spmi/peningkatan', [UploadController::class, 'createWithContext'])
        ->name('upload.spmi-peningkatan');
    
    Route::get('/spmi/akreditasi/{id}', [UploadController::class, 'createWithContext'])
        ->name('upload.spmi-akreditasi');
});

// ==================== PROTECTED ROUTES (SETELAH LOGIN) ====================
Route::middleware(['auth'])->group(function () {

     Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
    });
    
    
    // Dashboard (role-based)
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // ==================== USER ROUTES ====================
    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function () {
        
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        // Upload Dokumen Routes
        Route::prefix('upload-dokumen')->group(function () {
            Route::get('/', [UploadController::class, 'create'])->name('upload-dokumen.create');
            Route::post('/', [UploadController::class, 'store'])->name('upload-dokumen.store');
            Route::get('/{id}/preview', [UploadController::class, 'preview'])->name('upload-dokumen.preview');
        });

        // Dokumen Saya Routes
        Route::prefix('dokumen-saya')->group(function () {
            Route::get('/', [UploadController::class, 'index'])->name('dokumen-saya');
            Route::get('/{id}', [UploadController::class, 'show'])->name('dokumen.show');
            Route::delete('/{id}', [UploadController::class, 'destroy'])->name('dokumen-saya.destroy');
            Route::get('/download/{id}', [UploadController::class, 'download'])->name('dokumen-saya.download');
            Route::get('/preview/{id}', [UploadController::class, 'preview'])->name('dokumen-saya.preview');
            Route::get('/{id}/edit', [UploadController::class, 'edit'])->name('dokumen-saya.edit');
            Route::put('/{id}', [UploadController::class, 'update'])->name('dokumen-saya.update');
        });

        // Search Routes
        Route::prefix('search')->group(function () {
            Route::get('/', [SearchController::class, 'index'])->name('search.index');
            Route::get('/results', [SearchController::class, 'search'])->name('search.results');
            Route::get('/dokumen/{id}/preview', [SearchController::class, 'preview'])->name('search.dokumen.preview');
            Route::get('/dokumen/{id}/download', [SearchController::class, 'download'])->name('search.dokumen.download');
        });
    });

    // ==================== ADMIN ROUTES ====================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // ==================== SPMI ROUTES ====================
        Route::prefix('spmi')->name('spmi.')->group(function () {
            
            // ===== PENETAPAN SPMI =====
            Route::prefix('penetapan')->name('penetapan.')->group(function () {
                Route::get('/', [PenetapanController::class, 'index'])->name('index');
                Route::get('/{id}', [PenetapanController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [PenetapanController::class, 'approve'])->name('approve');
            });

            // ===== PELAKSANAAN SPMI =====
            Route::prefix('pelaksanaan')->name('pelaksanaan.')->group(function () {
                Route::get('/', [PelaksanaanController::class, 'index'])->name('index');
                Route::get('/{id}', [PelaksanaanController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [PelaksanaanController::class, 'approve'])->name('approve');
            });

            // ===== EVALUASI SPMI =====
            Route::prefix('evaluasi')->name('evaluasi.')->group(function () {
                Route::get('/', [EvaluasiController::class, 'index'])->name('index');
                Route::get('/{id}', [EvaluasiController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [EvaluasiController::class, 'approve'])->name('approve');
            });

            // ===== PENINGKATAN SPMI =====
            Route::prefix('peningkatan')->name('peningkatan.')->group(function () {
                Route::get('/', [PeningkatanController::class, 'index'])->name('index');
                Route::get('/{id}', [PeningkatanController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [PeningkatanController::class, 'approve'])->name('approve');
            });

            // ===== PENGENDALIAN SPMI =====
            Route::prefix('pengendalian')->name('pengendalian.')->group(function () {
                Route::get('/', [PengendalianController::class, 'index'])->name('index');
                Route::get('/{id}', [PengendalianController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [PengendalianController::class, 'approve'])->name('approve');
            });

            // ===== AKREDITASI SPMI =====
            Route::prefix('akreditasi')->name('akreditasi.')->group(function () {
                Route::get('/', [AkreditasiController::class, 'index'])->name('index');
                Route::get('/{id}', [AkreditasiController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [AkreditasiController::class, 'approve'])->name('approve');
            });

            // ===== SPMI DASHBOARD =====
            Route::get('/dashboard', function () {
                return view('admin.spmi.dashboard');
            })->name('dashboard');
        });

        // Search Routes (Admin)
        Route::prefix('search')->group(function () {
            Route::get('/', [SearchController::class, 'index'])->name('search.index');
            Route::get('/results', [SearchController::class, 'search'])->name('search.results');
            Route::get('/dokumen/{id}/preview', [SearchController::class, 'preview'])->name('search.dokumen.preview');
            Route::get('/dokumen/{id}/download', [SearchController::class, 'download'])->name('search.dokumen.download');
        });

        // ==================== SETTINGS ROUTES (Admin Only) ====================
        Route::prefix('settings')->group(function () {
            
            Route::prefix('iku')->group(function () {
                Route::get('/', [SettingController::class, 'indexIku'])->name('settings.iku.index');
                Route::get('/create', [SettingController::class, 'createIku'])->name('settings.iku.create');
                Route::post('/', [SettingController::class, 'storeIku'])->name('settings.iku.store');
                Route::get('/{id}/edit', [SettingController::class, 'editIku'])->name('settings.iku.edit');
                Route::put('/{id}', [SettingController::class, 'updateIku'])->name('settings.iku.update');
                Route::delete('/{id}', [SettingController::class, 'destroyIku'])->name('settings.iku.destroy');
            });

            Route::prefix('unit-kerja')->group(function () {
                Route::get('/', [SettingController::class, 'indexUnitKerja'])->name('settings.unit-kerja.index');
                Route::get('/create', [SettingController::class, 'createUnitKerja'])->name('settings.unit-kerja.create');
                Route::post('/', [SettingController::class, 'storeUnitKerja'])->name('settings.unit-kerja.store');
                Route::get('/{id}/edit', [SettingController::class, 'editUnitKerja'])->name('settings.unit-kerja.edit');
                Route::put('/{id}', [SettingController::class, 'updateUnitKerja'])->name('settings.unit-kerja.update');
                Route::delete('/{id}', [SettingController::class, 'destroyUnitKerja'])->name('settings.unit-kerja.destroy');
            });
            
            Route::prefix('spmi')->group(function () {
                Route::get('/', [SettingController::class, 'indexSpm'])->name('settings.spmi.index');
                Route::put('/update', [SettingController::class, 'updateSpm'])->name('settings.spmi.update');
            });
        });

        // ==================== KELOLA AKUN (Admin Only) ====================
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::get('/{id}', [UserController::class, 'show'])->name('show');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-delete', [UserController::class, 'bulkDelete'])->name('bulk-delete');
            Route::post('/{id}/toggle-active', [UserController::class, 'toggleActive'])->name('toggle-active');
            Route::get('/export/csv', [UserController::class, 'exportCsv'])->name('export.csv');
        });

        // ==================== DOKUMEN MANAGEMENT (Admin) ====================
        Route::prefix('dokumen')->name('dokumen.')->group(function () {
            Route::get('/', [DokumenController::class, 'index'])->name('index');
            Route::get('/{id}', [DokumenController::class, 'show'])->name('show');
        Route::get('trash', [DokumenController::class, 'trash'])->name('trash');
        Route::post('bulk-action', [DokumenController::class, 'bulkAction'])->name('bulk-action');
        Route::put('{id}/status', [DokumenController::class, 'updateStatus'])->name('update-status');
        Route::get('{id}/approve-form', [DokumenController::class, 'approveForm'])->name('approve-form');
        Route::post('{id}/approve', [DokumenController::class, 'approve'])->name('approve');
        Route::post('{id}/reject', [DokumenController::class, 'reject'])->name('reject');
        Route::delete('{id}/soft-delete', [DokumenController::class, 'softDelete'])->name('soft-delete');
        Route::post('{id}/restore', [DokumenController::class, 'restore'])->name('restore');
        Route::get('{id}/download', [DokumenController::class, 'download'])->name('download');
        Route::get('{id}/preview', [DokumenController::class, 'preview'])->name('preview');
        Route::get('export', [DokumenController::class, 'export'])->name('export');
    });
    }); // <-- TUTUP UNTUK ADMIN ROUTES
    
}); // <-- TUTUP UNTUK AUTH MIDDLEWARE

// ==================== ERROR PAGES ====================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});