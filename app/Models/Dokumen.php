<?php
// app/Models/Dokumen.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Dokumen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dokumens';

    protected $fillable = [
        'unit_kerja_id',
        'iku_id',
        'jenis_dokumen',
        'category',
        'nama_dokumen',
        'deskripsi',
        'file_path',
        'file_name',
        'file_size',
        'file_extension',
        'jenis_upload',
        'status',
        'admin_note',
        'approved_by',
        'approved_at',
        'metadata',
        'uploaded_by',
        'is_public',
        'tahapan',
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_public' => 'boolean',
        'file_size' => 'integer',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = [
        'file_size_formatted',
        'status_badge',
        'status_color',
        'category_label',
    ];

    // ==================== RELATIONSHIPS ====================
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function iku()
    {
        return $this->belongsTo(Iku::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // ==================== ACCESSORS ====================
    protected function fileSizeFormatted(): Attribute
    {
        return Attribute::make(
            get: function () {
                $bytes = $this->file_size;
                if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
                if ($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
                if ($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
                return $bytes . ' bytes';
            }
        );
    }

    protected function statusBadge(): Attribute
    {
        return Attribute::make(
            get: fn() => match($this->status) {
                'pending' => '<span class="badge bg-warning">Pending</span>',
                'approved' => '<span class="badge bg-success">Approved</span>',
                'rejected' => '<span class="badge bg-danger">Rejected</span>',
                default => '<span class="badge bg-secondary">Unknown</span>',
            }
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn() => match($this->status) {
                'pending' => 'warning',
                'approved' => 'success',
                'rejected' => 'danger',
                default => 'secondary',
            }
        );
    }

    protected function categoryLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => match($this->category) {
                'penetapan' => 'Penetapan SPMI',
                'pelaksanaan' => 'Pelaksanaan SPMI',
                'evaluasi' => 'Evaluasi SPMI',
                'pengendalian' => 'Pengendalian SPMI',
                'peningkatan' => 'Peningkatan SPMI',
                default => ucfirst($this->category ?? 'Umum'),
            }
        );
    }

    public function getIconAttribute()
    {
        return match($this->category) {
            'penetapan' => 'fa-file-signature',
            'pelaksanaan' => 'fa-play-circle',
            'evaluasi' => 'fa-chart-line',
            'pengendalian' => 'fa-tasks',
            'peningkatan' => 'fa-chart-bar',
            default => 'fa-file',
        };
    }

    public function getIconColorAttribute()
    {
        return match($this->category) {
            'penetapan' => 'primary',
            'pelaksanaan' => 'success',
            'evaluasi' => 'warning',
            'pengendalian' => 'danger',
            'peningkatan' => 'info',
            default => 'secondary',
        };
    }

    // ==================== HELPER METHODS ====================
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

   public function approve(int $adminId, ?string $note = null): bool
    {
    return $this->update([
        'status' => 'approved',
        'approved_by' => $adminId,
        'admin_note' => $note,
        'approved_at' => now(),
    ]);
    }

    public function reject(int $adminId, string $note): bool
    {
        return $this->update([
            'status' => 'rejected',
            'approved_by' => $adminId,
            'admin_note' => $note,
            'approved_at' => now(),
        ]);
    }

    // ==================== SCOPES ====================
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    public function scopeByStatus($query, $status)
    {
        if ($status && $status !== 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nama_dokumen', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('uploader', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        }
        return $query;
    }

    // ==================== BOOT ====================
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->status)) {
                $model->status = 'pending';
            }
        });
    }
}