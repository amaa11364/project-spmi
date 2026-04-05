@extends('layouts.app')

@section('title', 'Unit Pelaksana Teknis')

@section('page-icon', 'fa-building')

@push('styles')
<style>
    :root {
        --primary-brown: #996600;
        --secondary-brown: #b37400;
        --dark-brown: #7a5200;
        --light-brown: #fff9e6;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--dark-brown) 100%);
        color: white;
        padding: 80px 0 60px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        border-radius: 0 0 30px 30px;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
        opacity: 0.1;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        animation: fadeInUp 1s ease;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        animation: fadeInUp 1s ease 0.2s both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stats Cards */
    .stats-wrapper {
        margin-top: -30px;
        position: relative;
        z-index: 10;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(153, 102, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(153, 102, 0, 0.15);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: var(--light-brown);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary-brown);
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark-brown);
        line-height: 1.2;
    }

    .stat-label {
        color: #666;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Section Title */
    .section-title {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .section-title h2 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark-brown);
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--primary-brown);
        border-radius: 2px;
    }

    .section-title p {
        color: #666;
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* UPT Cards */
    .upt-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        border: 1px solid #e9ecef;
    }

    .upt-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(153, 102, 0, 0.15);
    }

    .upt-card-header {
        height: 100px;
        background: linear-gradient(135deg, var(--primary-brown), var(--dark-brown));
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upt-card-header::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 25px;
        background: white;
        border-radius: 25px 25px 0 0;
    }

    .upt-icon-wrapper {
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary-brown);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        position: relative;
        z-index: 2;
        transform: translateY(25px);
    }

    .upt-card-body {
        padding: 45px 15px 20px;
        text-align: center;
    }

    .upt-card-body h5 {
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .upt-card-body p {
        color: #666;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }

    .badge-custom {
        padding: 4px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.7rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #d4edda;
        color: #155724;
    }

    .upt-footer {
        padding: 12px 15px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .upt-meta {
        color: #666;
        font-size: 0.8rem;
    }

    .upt-meta i {
        color: var(--primary-brown);
    }

    .btn-detail {
        padding: 5px 15px;
        border-radius: 6px;
        background: var(--light-brown);
        color: var(--primary-brown);
        border: none;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-detail:hover {
        background: var(--primary-brown);
        color: white;
    }

    /* Featured Section */
    .featured-section {
        background: white;
        padding: 40px 0;
        margin: 40px 0;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .feature-card {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 12px;
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #e9ecef;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(153, 102, 0, 0.1);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        background: var(--light-brown);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary-brown);
        margin: 0 auto 1rem;
    }

    .feature-card h4 {
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .feature-card p {
        color: #666;
        font-size: 0.85rem;
        margin: 0;
    }

    .info-text {
        background: var(--light-brown);
        color: var(--primary-brown);
        padding: 12px 20px;
        border-radius: 10px;
        margin-top: 20px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--dark-brown) 100%);
        color: white;
        padding: 1.2rem;
        border: none;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .detail-icon {
        width: 45px;
        height: 45px;
        background: var(--light-brown);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-brown);
        font-size: 1.2rem;
    }

    .detail-content h6 {
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 3px;
        font-size: 0.9rem;
    }

    .detail-content p {
        color: #666;
        margin: 0;
        font-size: 0.85rem;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="hero-title">Unit Pelaksana Teknis</h1>
                <p class="hero-subtitle">Mendukung pencapaian visi dan misi IKIP Siliwangi melalui layanan prima dan inovatif</p>
            </div>
            <div class="col-lg-4 text-end">
                <i class="fas fa-building fa-5x opacity-25"></i>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Stats Section -->
    <div class="stats-wrapper">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-number">8</div>
                    <div class="stat-label">Total UPT</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">125+</div>
                    <div class="stat-label">Tenaga Ahli & Staf</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Program Layanan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- UPT Grid Section -->
    <div class="mt-5" id="upt">
        <div class="section-title">
            <h2>Jelajahi UPT Kami</h2>
            <p>Temukan berbagai layanan dan fasilitas yang tersedia di setiap unit pelaksana teknis</p>
        </div>

        <div class="row g-3">
            @php
                $uptList = [
                    ['name' => 'UPT Perpustakaan', 'icon' => 'book', 'desc' => 'Pusat sumber belajar dan informasi ilmiah', 'meta' => '15k+ Koleksi'],
                    ['name' => 'UPT TIK', 'icon' => 'laptop', 'desc' => 'Teknologi Informasi & Komunikasi', 'meta' => '24/7 Layanan'],
                    ['name' => 'UPT Bahasa', 'icon' => 'language', 'desc' => 'Pengembangan dan layanan bahasa', 'meta' => '5 Bahasa'],
                    ['name' => 'UPT Laboratorium', 'icon' => 'flask', 'desc' => 'Laboratorium terpadu dan penelitian', 'meta' => '12 Lab'],
                    ['name' => 'UPT Pengembangan Karir', 'icon' => 'briefcase', 'desc' => 'Career center dan pengembangan profesional', 'meta' => '100+ Mitra'],
                    ['name' => 'UPT Publikasi', 'icon' => 'newspaper', 'desc' => 'Jurnal dan publikasi ilmiah', 'meta' => '15 Jurnal'],
                    ['name' => 'UPT Penjaminan Mutu', 'icon' => 'check-circle', 'desc' => 'Sistem penjaminan mutu internal', 'meta' => 'ISO 9001'],
                    ['name' => 'UPT Kerjasama', 'icon' => 'handshake', 'desc' => 'Hubungan masyarakat dan kerjasama', 'meta' => '50+ Mitra']
                ];
            @endphp

            @foreach($uptList as $index => $upt)
            <div class="col-lg-3 col-md-6">
                <div class="upt-card">
                    <div class="upt-card-header">
                        <div class="upt-icon-wrapper">
                            <i class="fas fa-{{ $upt['icon'] }}"></i>
                        </div>
                    </div>
                    <div class="upt-card-body">
                        <h5>{{ $upt['name'] }}</h5>
                        <p>{{ $upt['desc'] }}</p>
                        <span class="badge-custom">
                            <i class="fas fa-circle fa-2xs"></i> Aktif
                        </span>
                    </div>
                    <div class="upt-footer">
                        <div class="upt-meta">
                            <i class="fas fa-{{ $upt['icon'] }} me-1"></i> {{ $upt['meta'] }}
                        </div>
                        <button class="btn-detail" onclick="showDetail({{ $index }})">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Featured Services -->
    <div class="featured-section" id="layanan">
        <div class="container">
            <div class="section-title">
                <h2>Layanan Unggulan</h2>
                <p>Tiga layanan unggulan yang tersedia di seluruh UPT untuk mendukung kegiatan akademik dan non-akademik</p>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h4>Digital Library</h4>
                        <p>Akses ke ribuan e-book dan jurnal internasional 24/7 dari mana saja.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h4>Smart Campus</h4>
                        <p>Sistem terintegrasi untuk memudahkan akses layanan akademik.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Research Support</h4>
                        <p>Pendukung penelitian dengan laboratorium dan publikasi terakreditasi.</p>
                    </div>
                </div>
            </div>
            <div class="info-text">
                <i class="fas fa-info-circle"></i>
                <span>Ketiga layanan unggulan ini merupakan kolaborasi antar UPT untuk memberikan pelayanan terbaik bagi sivitas akademika.</span>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail UPT -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Detail UPT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be filled by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background: #e9ecef; color: #495057;" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn" style="background: var(--primary-brown); color: white;">
                    <i class="fas fa-external-link-alt me-2"></i>Kunjungi Website
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const uptList = @json($uptList);

    function showDetail(index) {
        const upt = uptList[index];
        
        document.getElementById('modalTitle').innerHTML = `<i class="fas fa-${upt.icon} me-2"></i>${upt.name}`;

        let detailsHtml = `
            <p style="color: #666; margin-bottom: 1.5rem;">${upt.desc}</p>
            <h6 style="color: var(--dark-brown); font-weight: 700; margin-bottom: 1rem;">
                <i class="fas fa-info-circle me-2" style="color: var(--primary-brown);"></i>Informasi Detail
            </h6>
        `;

        const detailItems = [
            { icon: 'map-marker-alt', label: 'Lokasi', value: 'Gedung Rektorat Lantai 2' },
            { icon: 'phone', label: 'Telepon', value: '(022) 1234-5678' },
            { icon: 'envelope', label: 'Email', value: `${upt.name.toLowerCase().replace(/ /g, '.')}@ikipsiliwangi.ac.id` },
            { icon: 'clock', label: 'Jam Operasional', value: 'Senin - Jumat, 08.00 - 16.00 WIB' },
            { icon: 'users', label: 'Jumlah Staff', value: '15 orang' }
        ];

        detailItems.forEach(item => {
            detailsHtml += `
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-${item.icon}"></i>
                    </div>
                    <div class="detail-content">
                        <h6>${item.label}</h6>
                        <p>${item.value}</p>
                    </div>
                </div>
            `;
        });

        document.getElementById('modalBody').innerHTML = detailsHtml;

        const modal = new bootstrap.Modal(document.getElementById('detailModal'));
        modal.show();
    }
</script>
@endsection