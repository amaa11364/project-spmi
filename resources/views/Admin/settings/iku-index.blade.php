@extends('layouts.main')

@section('title', 'Pengaturan IKU')

@section('page-icon', 'fa-chart-line')

@section('content')
<div class="container-fluid px-3">
    <!-- Header Section -->
    <div class="custom-card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center p-3">
            <div>
                <h5 class="fw-bold mb-1" style="color: var(--dark-brown);">
                    <i class="fas fa-chart-line me-2" style="color: var(--primary-brown);"></i>
                    Pengaturan IKU
                </h5>
                <p class="text-muted small mb-0">Kelola Indikator Kinerja Utama (IKU)</p>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge" style="background: var(--light-brown); color: var(--primary-brown); padding: 8px 15px; border-radius: 20px;">
                    <i class="fas fa-list me-1"></i> Total: {{ $ikus->count() }} IKU
                </span>
                <a href="{{ route('admin.settings.iku.create') }}" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 18px; border-radius: 8px;">
                    <i class="fas fa-plus me-2"></i>Tambah IKU
                </a>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="custom-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: var(--light-brown);">
                        <tr>
                            <th class="py-3 ps-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">KODE</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">NAMA IKU</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">DESKRIPSI</th>
                            <th class="py-3" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">STATUS</th>
                            <th class="py-3 pe-4" style="color: var(--dark-brown); font-weight: 600; font-size: 0.85rem;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ikus as $iku)
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <span class="badge" style="background: var(--primary-brown); color: white; padding: 6px 12px; border-radius: 6px;">
                                    {{ $iku->kode }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2" style="width: 32px; height: 32px; background: var(--light-brown); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-chart-line" style="color: var(--primary-brown); font-size: 14px;"></i>
                                    </div>
                                    <span class="fw-medium">{{ $iku->nama }}</span>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($iku->deskripsi, 50) ?: '-' }}</small>
                            </td>
                            <td>
                                @if($iku->status)
                                    <span class="badge" style="background: #d4edda; color: #155724; padding: 6px 12px; border-radius: 20px;">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge" style="background: #e9ecef; color: #6c757d; padding: 6px 12px; border-radius: 20px;">
                                        <i class="fas fa-times-circle me-1"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.settings.iku.edit', $iku->id) }}" 
                                       class="btn btn-sm" 
                                       style="background: var(--light-brown); color: var(--primary-brown); border-radius: 6px; padding: 5px 12px;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm" 
                                            style="background: #f8d7da; color: #721c24; border-radius: 6px; padding: 5px 12px;"
                                            onclick="confirmDelete('{{ route('admin.settings.iku.destroy', $iku->id) }}', '{{ $iku->nama }}')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="opacity: 0.5;">
                                    <i class="fas fa-chart-line" style="font-size: 48px; color: #ccc;"></i>
                                    <p class="mt-3 text-muted">Belum ada IKU yang ditambahkan</p>
                                    <a href="{{ route('admin.settings.iku.create') }}" class="btn" style="background: var(--primary-brown); color: white; padding: 8px 20px; border-radius: 8px;">
                                        <i class="fas fa-plus me-2"></i>Tambah IKU Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(url, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus IKU "${name}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush