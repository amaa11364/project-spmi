@extends('layouts.app')

@section('title', 'Unit Kerja')

@section('page-icon', 'fa-sitemap')

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
        margin-bottom: 1.5rem;
    }

    .section-title h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--dark-brown);
        margin-bottom: 0.3rem;
    }

    .section-title p {
        color: #666;
        font-size: 0.95rem;
    }

    /* Unit Card */
    .unit-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        border: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
    }

    .unit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(153, 102, 0, 0.15);
    }

    .unit-card-header {
        padding: 15px 15px 0;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .unit-icon-wrapper {
        width: 50px;
        height: 50px;
        background: var(--light-brown);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary-brown);
    }

    .unit-badge {
        padding: 3px 8px;
        border-radius: 50px;
        font-size: 0.65rem;
        font-weight: 600;
        background: #d4edda;
        color: #155724;
    }

    .unit-card-body {
        padding: 10px 15px;
        flex-grow: 1;
    }

    .unit-card-body h4 {
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 0.3rem;
        font-size: 1rem;
    }

    .unit-card-body p {
        color: #666;
        font-size: 0.8rem;
        margin-bottom: 0.8rem;
    }

    .unit-stats {
        display: flex;
        gap: 12px;
        margin: 10px 0;
    }

    .unit-stat-item {
        text-align: center;
    }

    .unit-stat-value {
        font-weight: 700;
        color: var(--primary-brown);
        font-size: 0.95rem;
    }

    .unit-stat-label {
        font-size: 0.6rem;
        color: #999;
    }

    .unit-card-footer {
        padding: 10px 15px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafafa;
        font-size: 0.8rem;
    }

    .btn-detail {
        padding: 5px 12px;
        border-radius: 6px;
        background: var(--light-brown);
        color: var(--primary-brown);
        border: none;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-detail:hover {
        background: var(--primary-brown);
        color: white;
    }

    /* Subunit Card */
    .subunit-card {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #eee;
        cursor: pointer;
    }

    .subunit-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(153, 102, 0, 0.15);
        border-color: var(--primary-brown);
    }

    .subunit-icon {
        width: 40px;
        height: 40px;
        background: var(--light-brown);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--primary-brown);
        margin-bottom: 0.8rem;
    }

    .subunit-card h6 {
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .subunit-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 0.8rem;
    }

    .subunit-staff-count {
        background: #f0f0f0;
        padding: 2px 8px;
        border-radius: 50px;
        font-size: 0.65rem;
        color: #666;
    }

    .subunit-staff-count i {
        color: var(--primary-brown);
        margin-right: 3px;
    }

    .subunit-head {
        font-size: 0.7rem;
        color: #666;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .subunit-head i {
        color: var(--primary-brown);
        width: 16px;
    }

    .subunit-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
    }

    .subunit-ext {
        font-size: 0.6rem;
        color: #999;
    }

    .btn-subunit-detail {
        padding: 3px 8px;
        border-radius: 4px;
        background: transparent;
        color: var(--primary-brown);
        border: 1px solid var(--light-brown);
        font-weight: 600;
        font-size: 0.65rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-subunit-detail:hover {
        background: var(--primary-brown);
        color: white;
        border-color: var(--primary-brown);
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

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .detail-section {
        margin-bottom: 1.5rem;
    }

    .detail-title {
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--light-brown);
        display: inline-block;
        font-size: 1rem;
    }

    .staff-item {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 0.3rem;
    }

    .staff-item i {
        width: 30px;
        color: var(--primary-brown);
    }

    .contact-info {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
    }

    .contact-item i {
        width: 30px;
        height: 30px;
        background: var(--light-brown);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-brown);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="hero-title">Unit Kerja</h1>
                <p class="hero-subtitle">Struktur organisasi yang solid dengan SDM profesional untuk mendukung layanan terbaik</p>
            </div>
            <div class="col-lg-4 text-end">
                <i class="fas fa-sitemap fa-5x opacity-25"></i>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Stats Section -->
    <div class="stats-wrapper">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <div class="stat-number">6</div>
                    <div class="stat-label">Bagian Utama</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-code-branch"></i>
                    </div>
                    <div class="stat-number">12</div>
                    <div class="stat-label">Sub Bagian</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">85+</div>
                    <div class="stat-label">Staff Aktif</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Sertifikasi SDM</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Utama Section -->
    <div class="mt-4">
        <div class="section-title">
            <h2>Bagian Utama</h2>
            <p>Unit kerja utama yang mendukung operasional dan layanan akademik</p>
        </div>

        <div class="row g-3">
            <!-- Bagian Akademik -->
            <div class="col-lg-4 col-md-6">
                <div class="unit-card">
                    <div class="unit-card-header">
                        <div class="unit-icon-wrapper">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="unit-card-body">
                        <h4>Bagian Akademik</h4>
                        <p>Mengelola kurikulum, registrasi mahasiswa, penjadwalan, dan nilai</p>
                        <div class="unit-stats">
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">3</div>
                                <div class="unit-stat-label">Sub Bagian</div>
                            </div>
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">18</div>
                                <div class="unit-stat-label">Staff</div>
                            </div>
                        </div>
                    </div>
                    <div class="unit-card-footer">
                        <span><i class="fas fa-user-tie me-1" style="color: var(--primary-brown);"></i>Dr. Rina Wijaya, M.Pd.</span>
                        <button class="btn-detail" onclick="showUnitDetail('akademik')">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Bagian Keuangan -->
            <div class="col-lg-4 col-md-6">
                <div class="unit-card">
                    <div class="unit-card-header">
                        <div class="unit-icon-wrapper">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="unit-card-body">
                        <h4>Bagian Keuangan</h4>
                        <p>Perencanaan anggaran, akuntansi, dan pelaporan keuangan</p>
                        <div class="unit-stats">
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">3</div>
                                <div class="unit-stat-label">Sub Bagian</div>
                            </div>
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">15</div>
                                <div class="unit-stat-label">Staff</div>
                            </div>
                        </div>
                    </div>
                    <div class="unit-card-footer">
                        <span><i class="fas fa-user-tie me-1" style="color: var(--primary-brown);"></i>H. Dadang Kosasih, S.E.</span>
                        <button class="btn-detail" onclick="showUnitDetail('keuangan')">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Bagian Administrasi Umum -->
            <div class="col-lg-4 col-md-6">
                <div class="unit-card">
                    <div class="unit-card-header">
                        <div class="unit-icon-wrapper">
                            <i class="fas fa-archive"></i>
                        </div>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="unit-card-body">
                        <h4>Bagian Administrasi Umum</h4>
                        <p>Tata usaha, rumah tangga, dan perlengkapan</p>
                        <div class="unit-stats">
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">4</div>
                                <div class="unit-stat-label">Sub Bagian</div>
                            </div>
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">22</div>
                                <div class="unit-stat-label">Staff</div>
                            </div>
                        </div>
                    </div>
                    <div class="unit-card-footer">
                        <span><i class="fas fa-user-tie me-1" style="color: var(--primary-brown);"></i>Drs. H. Eko Prasetyo</span>
                        <button class="btn-detail" onclick="showUnitDetail('admum')">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Bagian Kemahasiswaan -->
            <div class="col-lg-4 col-md-6">
                <div class="unit-card">
                    <div class="unit-card-header">
                        <div class="unit-icon-wrapper">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="unit-card-body">
                        <h4>Bagian Kemahasiswaan</h4>
                        <p>Minat bakat, organisasi mahasiswa, dan beasiswa</p>
                        <div class="unit-stats">
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">3</div>
                                <div class="unit-stat-label">Sub Bagian</div>
                            </div>
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">14</div>
                                <div class="unit-stat-label">Staff</div>
                            </div>
                        </div>
                    </div>
                    <div class="unit-card-footer">
                        <span><i class="fas fa-user-tie me-1" style="color: var(--primary-brown);"></i>Dra. Yuniarti, M.Si.</span>
                        <button class="btn-detail" onclick="showUnitDetail('kemahasiswaan')">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Bagian Sumber Daya -->
            <div class="col-lg-4 col-md-6">
                <div class="unit-card">
                    <div class="unit-card-header">
                        <div class="unit-icon-wrapper">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="unit-card-body">
                        <h4>Bagian Sumber Daya</h4>
                        <p>SDM, pengembangan kompetensi, dan karir pegawai</p>
                        <div class="unit-stats">
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">2</div>
                                <div class="unit-stat-label">Sub Bagian</div>
                            </div>
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">10</div>
                                <div class="unit-stat-label">Staff</div>
                            </div>
                        </div>
                    </div>
                    <div class="unit-card-footer">
                        <span><i class="fas fa-user-tie me-1" style="color: var(--primary-brown);"></i>Dr. H. Ahmad Fauzi</span>
                        <button class="btn-detail" onclick="showUnitDetail('sumberdaya')">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Bagian Kerjasama -->
            <div class="col-lg-4 col-md-6">
                <div class="unit-card">
                    <div class="unit-card-header">
                        <div class="unit-icon-wrapper">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="unit-card-body">
                        <h4>Bagian Kerjasama</h4>
                        <p>Humas, kerjasama dalam dan luar negeri</p>
                        <div class="unit-stats">
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">2</div>
                                <div class="unit-stat-label">Sub Bagian</div>
                            </div>
                            <div class="unit-stat-item">
                                <div class="unit-stat-value">8</div>
                                <div class="unit-stat-label">Staff</div>
                            </div>
                        </div>
                    </div>
                    <div class="unit-card-footer">
                        <span><i class="fas fa-user-tie me-1" style="color: var(--primary-brown);"></i>Dr. Nina Herlina</span>
                        <button class="btn-detail" onclick="showUnitDetail('kerjasama')">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub Bagian Section -->
    <div class="mt-5">
        <div class="section-title">
            <h2>Sub Bagian</h2>
            <p>Unit kerja pendukung dengan layanan spesifik dan profesional</p>
        </div>

        <div class="row g-3">
            <!-- Sub Bagian Tata Usaha -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('tatausaha')">
                    <div class="subunit-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h6>Sub Bagian Tata Usaha</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 6 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Drs. Bambang Susilo
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1101</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('tatausaha')">Detail</span>
                    </div>
                </div>
            </div>

            <!-- Sub Bagian Keuangan -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('keuangan')">
                    <div class="subunit-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h6>Sub Bagian Keuangan</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 5 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Sri Wahyuni, S.E.
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1102</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('keuangan')">Detail</span>
                    </div>
                </div>
            </div>

            <!-- Sub Bagian Perlengkapan -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('perlengkapan')">
                    <div class="subunit-icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <h6>Sub Bagian Perlengkapan</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 4 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Joko Widodo
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1103</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('perlengkapan')">Detail</span>
                    </div>
                </div>
            </div>

            <!-- Sub Bagian Kepegawaian -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('kepegawaian')">
                    <div class="subunit-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h6>Sub Bagian Kepegawaian</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 5 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Dra. Hj. Siti Khodijah
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1104</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('kepegawaian')">Detail</span>
                    </div>
                </div>
            </div>

            <!-- Sub Bagian Akademik -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('akademik')">
                    <div class="subunit-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h6>Sub Bagian Akademik</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 6 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Dra. Siti Aminah
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1105</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('akademik')">Detail</span>
                    </div>
                </div>
            </div>

            <!-- Sub Bagian Kemahasiswaan -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('kemahasiswaan')">
                    <div class="subunit-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h6>Sub Bagian Kemahasiswaan</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 5 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Agus Setiawan, S.Or.
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1106</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('kemahasiswaan')">Detail</span>
                    </div>
                </div>
            </div>

            <!-- Sub Bagian Kerjasama -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('kerjasama')">
                    <div class="subunit-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h6>Sub Bagian Kerjasama</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 4 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Indra Gunawan, S.I.Kom.
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1107</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('kerjasama')">Detail</span>
                    </div>
                </div>
            </div>

            <!-- Sub Bagian Perencanaan -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="subunit-card" onclick="showSubUnitDetail('perencanaan')">
                    <div class="subunit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h6>Sub Bagian Perencanaan</h6>
                    <div class="subunit-meta">
                        <span class="subunit-staff-count"><i class="fas fa-users"></i> 4 Staff</span>
                        <span class="unit-badge">Aktif</span>
                    </div>
                    <div class="subunit-head">
                        <i class="fas fa-user-tie"></i> Eko Prasetyo, S.E.
                    </div>
                    <div class="subunit-footer">
                        <span class="subunit-ext"><i class="fas fa-phone"></i> Ext. 1108</span>
                        <span class="btn-subunit-detail" onclick="event.stopPropagation(); showSubUnitDetail('perencanaan')">Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Unit -->
<div class="modal fade" id="unitDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-building me-2"></i>Detail Unit Kerja
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="unitModalDetailContent">
                <!-- Content will be dynamically inserted here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Sub Unit -->
<div class="modal fade" id="subUnitDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-code-branch me-2"></i>Detail Sub Bagian
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="subUnitModalDetailContent">
                <!-- Content will be dynamically inserted here -->
            </div>
        </div>
    </div>
</div>

<script>
    function showUnitDetail(unitId) {
        let title = '';
        let kepala = '';
        let staff = '';
        let subbagian = '';
        
        if (unitId === 'akademik') {
            title = 'Bagian Akademik';
            kepala = 'Dr. Rina Wijaya, M.Pd.';
            staff = '18 orang';
            subbagian = '3 unit';
        } else if (unitId === 'keuangan') {
            title = 'Bagian Keuangan';
            kepala = 'H. Dadang Kosasih, S.E.';
            staff = '15 orang';
            subbagian = '3 unit';
        } else if (unitId === 'admum') {
            title = 'Bagian Administrasi Umum';
            kepala = 'Drs. H. Eko Prasetyo';
            staff = '22 orang';
            subbagian = '4 unit';
        } else if (unitId === 'kemahasiswaan') {
            title = 'Bagian Kemahasiswaan';
            kepala = 'Dra. Yuniarti, M.Si.';
            staff = '14 orang';
            subbagian = '3 unit';
        } else if (unitId === 'sumberdaya') {
            title = 'Bagian Sumber Daya';
            kepala = 'Dr. H. Ahmad Fauzi';
            staff = '10 orang';
            subbagian = '2 unit';
        } else if (unitId === 'kerjasama') {
            title = 'Bagian Kerjasama';
            kepala = 'Dr. Nina Herlina';
            staff = '8 orang';
            subbagian = '2 unit';
        }
        
        let content = `
            <div class="detail-section">
                <h6 class="detail-title"><i class="fas fa-info-circle me-2"></i>Informasi Unit</h6>
                <div class="contact-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-user-tie"></i>
                                <div><strong>Kepala Bagian:</strong><br>${kepala}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-users"></i>
                                <div><strong>Jumlah Staff:</strong><br>${staff}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-code-branch"></i>
                                <div><strong>Sub Bagian:</strong><br>${subbagian}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div><strong>Telepon:</strong><br>(022) 1234-5678</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('unitModalDetailContent').innerHTML = content;
        
        const modal = new bootstrap.Modal(document.getElementById('unitDetailModal'));
        modal.show();
    }

    function showSubUnitDetail(unitId) {
        let name = '';
        let parent = '';
        let kepala = '';
        let staff = '';
        let ext = '';
        
        if (unitId === 'tatausaha') {
            name = 'Sub Bagian Tata Usaha';
            parent = 'Administrasi Umum';
            kepala = 'Drs. Bambang Susilo';
            staff = '6 orang';
            ext = '1101';
        } else if (unitId === 'keuangan') {
            name = 'Sub Bagian Keuangan';
            parent = 'Keuangan';
            kepala = 'Sri Wahyuni, S.E.';
            staff = '5 orang';
            ext = '1102';
        } else if (unitId === 'perlengkapan') {
            name = 'Sub Bagian Perlengkapan';
            parent = 'Administrasi Umum';
            kepala = 'Joko Widodo';
            staff = '4 orang';
            ext = '1103';
        } else if (unitId === 'kepegawaian') {
            name = 'Sub Bagian Kepegawaian';
            parent = 'Sumber Daya';
            kepala = 'Dra. Hj. Siti Khodijah';
            staff = '5 orang';
            ext = '1104';
        } else if (unitId === 'akademik') {
            name = 'Sub Bagian Akademik';
            parent = 'Akademik';
            kepala = 'Dra. Siti Aminah';
            staff = '6 orang';
            ext = '1105';
        } else if (unitId === 'kemahasiswaan') {
            name = 'Sub Bagian Kemahasiswaan';
            parent = 'Kemahasiswaan';
            kepala = 'Agus Setiawan, S.Or.';
            staff = '5 orang';
            ext = '1106';
        } else if (unitId === 'kerjasama') {
            name = 'Sub Bagian Kerjasama';
            parent = 'Kerjasama';
            kepala = 'Indra Gunawan, S.I.Kom.';
            staff = '4 orang';
            ext = '1107';
        } else if (unitId === 'perencanaan') {
            name = 'Sub Bagian Perencanaan';
            parent = 'Keuangan';
            kepala = 'Eko Prasetyo, S.E.';
            staff = '4 orang';
            ext = '1108';
        }
        
        let content = `
            <div class="detail-section">
                <span class="badge bg-secondary mb-2"><i class="fas fa-sitemap me-1"></i>${parent}</span>
                <div class="contact-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-user-tie"></i>
                                <div><strong>Kepala Sub Bagian:</strong><br>${kepala}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-users"></i>
                                <div><strong>Jumlah Staff:</strong><br>${staff}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div><strong>Telepon:</strong><br>(022) 1234-5678 ext. ${ext}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div><strong>Email:</strong><br>${name.toLowerCase().replace(/ /g, '.')}@ikipsiliwangi.ac.id</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('subUnitModalDetailContent').innerHTML = content;
        
        const modal = new bootstrap.Modal(document.getElementById('subUnitDetailModal'));
        modal.show();
    }
</script>
@endsection