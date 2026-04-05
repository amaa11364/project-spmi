@extends('layouts.app')

@section('title', 'Program Studi')

@section('page-icon', 'fa-graduation-cap')

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

    /* Category Badge */
    .category-badge {
        display: inline-block;
        padding: 8px 25px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .badge-s1 {
        background: linear-gradient(135deg, var(--primary-brown), var(--dark-brown));
    }

    .badge-profesi {
        background: linear-gradient(135deg, #9C27B0, #7B1FA2);
    }

    .badge-s2 {
        background: linear-gradient(135deg, #009688, #00695C);
    }

    /* Program Studi Cards */
    .prodi-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        border: 1px solid #e9ecef;
    }

    .prodi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(153, 102, 0, 0.15);
    }

    .prodi-card-header {
        height: 80px;
        background: linear-gradient(135deg, var(--primary-brown), var(--dark-brown));
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .prodi-card-header.s1 {
        background: linear-gradient(135deg, var(--primary-brown), var(--dark-brown));
    }

    .prodi-card-header.profesi {
        background: linear-gradient(135deg, #9C27B0, #7B1FA2);
    }

    .prodi-card-header.s2 {
        background: linear-gradient(135deg, #009688, #00695C);
    }

    .prodi-icon-wrapper {
        width: 60px;
        height: 60px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--primary-brown);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        position: relative;
        z-index: 2;
        transform: translateY(30px);
    }

    .prodi-icon-wrapper.s1 {
        color: var(--primary-brown);
    }

    .prodi-icon-wrapper.profesi {
        color: #9C27B0;
    }

    .prodi-icon-wrapper.s2 {
        color: #009688;
    }

    .prodi-card-body {
        padding: 40px 15px 15px;
        text-align: center;
    }

    .prodi-card-body h5 {
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 0.5rem;
        font-size: 1rem;
        min-height: 45px;
    }

    .akreditasi-badge {
        padding: 4px 10px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin: 10px 0;
    }

    .akreditasi-unggul {
        background: #d4edda;
        color: #155724;
    }

    .akreditasi-baik {
        background: #fff3cd;
        color: #856404;
    }

    .prodi-footer {
        padding: 12px 15px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .prodi-meta {
        color: #666;
        font-size: 0.8rem;
    }

    .prodi-meta i {
        color: var(--primary-brown);
    }

    .btn-detail {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--light-brown);
        color: var(--primary-brown);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        background: var(--primary-brown);
        color: white;
        transform: scale(1.1);
    }

    /* Quick Facts */
    .quick-facts {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin: 3rem 0;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
    }

    .fact-item {
        text-align: center;
    }

    .fact-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary-brown);
        margin-bottom: 0.3rem;
    }

    .fact-label {
        color: #666;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--dark-brown) 100%);
        padding: 50px 0;
        border-radius: 20px;
        margin: 50px 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .btn-cta {
        background: white;
        color: var(--primary-brown);
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .prodi-card-body h5 {
            font-size: 0.95rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="hero-title">Program Studi</h1>
                <p class="hero-subtitle">Program studi terakreditasi dengan kurikulum berbasis kompetensi dan kebutuhan industri</p>
            </div>
            <div class="col-lg-4 text-end">
                <i class="fas fa-graduation-cap fa-5x opacity-25"></i>
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
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="stat-number">14</div>
                    <div class="stat-label">Total Program Studi</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number">10</div>
                    <div class="stat-label">Akreditasi Unggul</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">2.500+</div>
                    <div class="stat-label">Mahasiswa Aktif</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Facts -->
    <div class="quick-facts">
        <div class="row">
            <div class="col-md-4">
                <div class="fact-item">
                    <div class="fact-number">7</div>
                    <div class="fact-label">Program Sarjana (S1)</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fact-item">
                    <div class="fact-number">1</div>
                    <div class="fact-label">Program Profesi</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fact-item">
                    <div class="fact-number">5</div>
                    <div class="fact-label">Program Magister (S2)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- PROGRAM STUDI PRASARJANA (S1) -->
    <div class="mt-5">
        <div class="text-center">
            <div class="category-badge badge-s1">
                <i class="fas fa-graduation-cap me-2"></i>PROGRAM STUDI PRASARJANA (S1)
            </div>
        </div>

        <div class="row g-3">
            <!-- S1 Bimbingan dan Konseling -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s1">
                        <div class="prodi-icon-wrapper s1">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>S1 Bimbingan dan Konseling</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 240 Mhs
                        </div>
                        <button class="btn-detail" onclick="showDetail('bk')">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S1 Pendidikan Masyarakat -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s1">
                        <div class="prodi-icon-wrapper s1">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>S1 Pendidikan Masyarakat</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 185 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S1 PGSD -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s1">
                        <div class="prodi-icon-wrapper s1">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>S1 PGSD</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 420 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S1 PG-PAUD -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s1">
                        <div class="prodi-icon-wrapper s1">
                            <i class="fas fa-child"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>S1 PG-PAUD</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 210 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S1 Pendidikan Bahasa dan Sastra Indonesia -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s1">
                        <div class="prodi-icon-wrapper s1">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>S1 Pendidikan Bahasa dan Sastra Indonesia</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 195 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S1 Pendidikan Bahasa Inggris -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s1">
                        <div class="prodi-icon-wrapper s1">
                            <i class="fas fa-language"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>S1 Pendidikan Bahasa Inggris</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 230 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S1 Pendidikan Matematika -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s1">
                        <div class="prodi-icon-wrapper s1">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>S1 Pendidikan Matematika</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 175 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PROGRAM STUDI PROFESI -->
    <div class="mt-5">
        <div class="text-center">
            <div class="category-badge badge-profesi">
                <i class="fas fa-certificate me-2"></i>PROGRAM STUDI PROFESI
            </div>
        </div>

        <div class="row g-3 justify-content-center">
            <!-- Pendidikan Profesi Guru -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header profesi">
                        <div class="prodi-icon-wrapper profesi">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>Pendidikan Profesi Guru</h5>
                        <span class="akreditasi-badge akreditasi-unggul">
                            <i class="fas fa-certificate"></i> Unggul
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 320 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PROGRAM STUDI PASCASARJANA (S2) -->
    <div class="mt-5">
        <div class="text-center">
            <div class="category-badge badge-s2">
                <i class="fas fa-user-graduate me-2"></i>PROGRAM STUDI PASCASARJANA (S2)
            </div>
        </div>

        <div class="row g-3">
            <!-- S2 Pendidikan Masyarakat -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s2">
                        <div class="prodi-icon-wrapper s2">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>Magister S2 Pendidikan Masyarakat</h5>
                        <span class="akreditasi-badge akreditasi-baik">
                            <i class="fas fa-certificate"></i> Baik Sekali
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 65 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S2 Pendidikan Matematika -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s2">
                        <div class="prodi-icon-wrapper s2">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>Magister S2 Pendidikan Matematika</h5>
                        <span class="akreditasi-badge akreditasi-baik">
                            <i class="fas fa-certificate"></i> Baik Sekali
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 45 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S2 Pendidikan Bahasa Indonesia -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s2">
                        <div class="prodi-icon-wrapper s2">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>Magister S2 Pendidikan Bahasa Indonesia</h5>
                        <span class="akreditasi-badge akreditasi-baik">
                            <i class="fas fa-certificate"></i> Baik Sekali
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 38 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S2 Pendidikan Dasar -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s2">
                        <div class="prodi-icon-wrapper s2">
                            <i class="fas fa-school"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>Magister S2 Pendidikan Dasar</h5>
                        <span class="akreditasi-badge akreditasi-baik">
                            <i class="fas fa-certificate"></i> Baik Sekali
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 52 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- S2 Pendidikan Bahasa Inggris -->
            <div class="col-lg-3 col-md-6">
                <div class="prodi-card">
                    <div class="prodi-card-header s2">
                        <div class="prodi-icon-wrapper s2">
                            <i class="fas fa-language"></i>
                        </div>
                    </div>
                    <div class="prodi-card-body">
                        <h5>Magister S2 Pendidikan Bahasa Inggris</h5>
                        <span class="akreditasi-badge akreditasi-baik">
                            <i class="fas fa-certificate"></i> Baik Sekali
                        </span>
                    </div>
                    <div class="prodi-footer">
                        <div class="prodi-meta">
                            <i class="fas fa-users me-1"></i> 42 Mhs
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section text-center">
        <div class="container">
            <h2 class="cta-title">Tertarik dengan Program Studi Kami?</h2>
            <p class="mb-4">Dapatkan informasi lengkap tentang pendaftaran, beasiswa, dan kurikulum</p>
            <a href="#" class="btn-cta">Info Pendaftaran</a>
        </div>
    </div>
</div>

<script>
    function showDetail(prodi) {
        alert('Fitur detail program studi akan segera hadir');
    }
</script>
@endsection