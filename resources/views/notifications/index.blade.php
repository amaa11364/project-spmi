{{-- resources/views/notifications/index.blade.php --}}
@extends('layouts.main')

@section('title', 'Notifikasi')
@section('page-icon', 'fa-bell')

@section('content')
<div class="container-fluid px-0">
    <div class="custom-card mb-4">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                        <i class="fas fa-bell me-2" style="color: var(--primary-brown);"></i>
                        Semua Notifikasi
                    </h5>
                    <p class="text-muted small mb-0">Daftar semua notifikasi Anda</p>
                </div>
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm" style="background: var(--light-brown); color: var(--primary-brown); border-radius: 8px; padding: 8px 15px;">
                        <i class="fas fa-check-double me-1"></i> Tandai semua dibaca
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="custom-card">
        <div class="card-body p-0">
            @forelse($notifications as $notification)
            <div class="notification-item-page {{ !$notification->is_read ? 'unread' : '' }}" style="padding: 15px 20px; border-bottom: 1px solid #e9ecef; {{ !$notification->is_read ? 'background: #fff9e6;' : '' }}">
                <div class="d-flex">
                    <div style="margin-right: 15px;">
                        <div style="width: 45px; height: 45px; background: var(--light-{{ $notification->color }}); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--{{ $notification->color }});">
                            <i class="fas {{ $notification->icon ?? 'fa-bell' }}" style="font-size: 20px;"></i>
                        </div>
                    </div>
                    <div style="flex: 1;">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 style="font-weight: 600; color: var(--dark-brown); margin-bottom: 5px;">{{ $notification->title }}</h6>
                                <p style="color: #6c757d; margin-bottom: 8px; font-size: 14px;">{{ $notification->message }}</p>
                                <small style="color: #adb5bd;">
                                    <i class="far fa-clock me-1"></i> {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <div>
                                @if($notification->action_url)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="btn btn-sm" style="background: var(--primary-brown); color: white; border-radius: 8px; padding: 5px 12px; font-size: 12px;">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                                @endif
                            </div>
                        </div>
                        @if($notification->data)
                        <div style="margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 8px; font-size: 12px; color: #495057;">
                            @if(isset($notification->data['dokumen_id']))
                            <span class="badge me-2" style="background: var(--light-brown); color: var(--primary-brown);">Dokumen ID: {{ $notification->data['dokumen_id'] }}</span>
                            @endif
                            @if(isset($notification->data['uploader_name']))
                            <span class="badge me-2" style="background: #e9ecef; color: #495057;">Oleh: {{ $notification->data['uploader_name'] }}</span>
                            @endif
                            @if(isset($notification->data['status']))
                            <span class="badge" style="background: {{ $notification->data['status'] == 'approved' ? '#d4edda' : '#f8d7da' }}; color: {{ $notification->data['status'] == 'approved' ? '#155724' : '#721c24' }};">
                                Status: {{ $notification->data['status'] == 'approved' ? 'Disetujui' : 'Ditolak' }}
                            </span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="padding: 50px 20px; text-align: center;">
                <i class="fas fa-bell-slash" style="font-size: 60px; color: #ccc; margin-bottom: 20px;"></i>
                <h6 style="color: #999;">Belum ada notifikasi</h6>
                <p style="color: #adb5bd; font-size: 14px;">Notifikasi akan muncul di sini ketika ada aktivitas</p>
            </div>
            @endforelse

            <div class="p-3 border-top">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>

<style>
.notification-item-page:hover {
    background: #f8f9fa !important;
}
.notification-item-page.unread:hover {
    background: #fff2d9 !important;
}
</style>
@endsection