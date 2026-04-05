<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'avatar',
        'phone',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * RELATIONSHIPS
     */

    /**
     * Documents uploaded by this user.
     */
    public function dokumens(): HasMany
    {
        return $this->hasMany(Dokumen::class, 'uploaded_by');
    }

    /**
     * Alias for dokumens().
     */
    public function uploadedDocuments(): HasMany
    {
        return $this->dokumens();
    }

    /**
     * Documents approved by this user.
     */
    public function approvedDocuments(): HasMany
    {
        return $this->hasMany(Dokumen::class, 'approved_by');
    }

    /**
     * ROLE / STATUS HELPERS
     */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    /**
     * SCOPES
     */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeRegularUser($query)
    {
        return $query->where('role', 'user');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        return $query;
    }

    /**
     * ACCESSORS & MUTATORS
     */

    /**
     * Get user initials from name
     */
    public function getInitials(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
                if (strlen($initials) >= 2) break;
            }
        }
        
        return $initials ?: 'U';
    }

    /**
     * Get user avatar URL (method)
     */
    public function getAvatarUrl(): ?string
    {
        // PERBAIKAN: Cek dengan benar path storage
        if ($this->avatar) {
            $path = 'avatars/' . $this->avatar;
            if (Storage::disk('public')->exists($path)) {
                return asset('storage/' . $path);
            }
        }
        
        return null;
    }

    /**
     * Get avatar URL as attribute
     */
    public function getAvatarUrlAttribute(): string
    {
        $url = $this->getAvatarUrl();
        
        if ($url) {
            return $url;
        }

        // Fallback to UI Avatars
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name)
            . '&color=7F9CF5&background=EBF4FF&length=2';
    }

    /**
     * Get initials as attribute
     */
    public function getInitialsAttribute(): string
    {
        return $this->getInitials();
    }

    public function getRoleLabelAttribute(): string
    {
        return $this->role === 'admin' ? 'Administrator' : 'User';
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->is_active ? 'Aktif' : 'Nonaktif';
    }

    public function getStatusClassAttribute(): string
    {
        return $this->is_active ? 'success' : 'danger';
    }

    public function getAvatarColorClassAttribute(): string
    {
        $colors = [
            'avatar-color-0',
            'avatar-color-1',
            'avatar-color-2',
            'avatar-color-3',
            'avatar-color-4',
            'avatar-color-5',
        ];

        $index = ($this->id ?? 1) % count($colors);

        return $colors[$index];
    }

    public function getTotalDocumentsAttribute(): int
    {
        return $this->dokumens()->count();
    }

    public function getTotalStorageUsedAttribute(): int
    {
        return $this->dokumens()
                    ->where('jenis_upload', 'file')
                    ->sum('file_size');
    }

    public function getFormattedStorageUsedAttribute(): string
    {
        $bytes = $this->total_storage_used;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' bytes';
    }

    public function getPublicDocumentsCountAttribute(): int
    {
        return $this->dokumens()->where('is_public', true)->count();
    }

    public function getPrivateDocumentsCountAttribute(): int
    {
        return $this->dokumens()->where('is_public', false)->count();
    }

    public function getFileDocumentsCountAttribute(): int
    {
        return $this->dokumens()->where('jenis_upload', 'file')->count();
    }

    public function getLinkDocumentsCountAttribute(): int
    {
        return $this->dokumens()->where('jenis_upload', 'link')->count();
    }

    /**
     * Delete user avatar
     */
    public function deleteAvatar(): void
    {
        if ($this->avatar && Storage::disk('public')->exists('avatars/' . $this->avatar)) {
            Storage::disk('public')->delete('avatars/' . $this->avatar);
        }
        
        $this->avatar = null;
        $this->save();
    }
}