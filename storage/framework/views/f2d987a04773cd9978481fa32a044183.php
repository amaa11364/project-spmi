<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-TRACK - SPMI Digital</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>?v=2">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('images/photos/25600_Logo-IKIP-warna.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('images/photos/25600_Logo-IKIP-warna.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('images/photos/25600_Logo-IKIP-warna.png')); ?>">

    <!-- SEO: Prevent Search Engine Indexing -->
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="bingbot" content="noindex, nofollow">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-brown: #996600;
            --secondary-brown: #b37400;
            --accent-brown: #cc9900;
            --dark-brown: #7a5200;
            --light-brown: #fff9e6;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        /* Custom Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 0 rgba(153, 102, 0, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(153, 102, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(153, 102, 0, 0); }
        }
        
        @keyframes slideInLeft {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeInUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes scaleIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        @keyframes rotateIn {
            from {
                transform: rotate(-180deg) scale(0.3);
                opacity: 0;
            }
            to {
                transform: rotate(0) scale(1);
                opacity: 1;
            }
        }
        
        /* Animation Classes */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 3s infinite;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.5rem 0;
            background: rgba(255, 255, 255, 0.98);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-brown) !important;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .nav-link {
            font-weight: 500;
            color: #374151 !important;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--primary-brown);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 80%;
        }
        
        .nav-link:hover {
            color: var(--primary-brown) !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-brown), var(--primary-brown));
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-brown), var(--dark-brown));
            transition: all 0.4s ease;
            z-index: -1;
        }
        
        .btn-primary:hover::before {
            left: 0;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(153, 102, 0, 0.3);
        }
        
        .btn-outline-light {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-outline-light::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: white;
            transition: all 0.4s ease;
            z-index: -1;
        }
        
        .btn-outline-light:hover::before {
            left: 0;
        }
        
        .btn-outline-light:hover {
            color: var(--primary-brown) !important;
            border-color: white;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-brown) 0%, var(--dark-brown) 100%);
            color: white;
            padding: 140px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23ffffff" fill-opacity="0.03" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
            animation: slideInRight 1.5s ease-out;
        }
        
        .hero-content {
            animation: slideInLeft 1s ease-out;
        }
        
        .hero-image {
            animation: float 6s ease-in-out infinite;
        }
        
        .program-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            border: 1px solid #e9ecef;
            position: relative;
            overflow: hidden;
        }
        
        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-brown), var(--accent-brown));
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }
        
        .program-card:hover::before {
            transform: translateX(0);
        }
        
        .program-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 30px rgba(153, 102, 0, 0.15);
        }
        
        .program-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: white;
            transition: all 0.4s ease;
        }
        
        .program-card:hover .program-icon {
            transform: rotate(360deg) scale(1.1);
        }
        
        .program-icon-sm {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin: 0 auto 10px;
            transition: all 0.3s ease;
        }
        
        .program-icon-sm:hover {
            transform: rotate(360deg) scale(1.1);
        }
        
        /* Update program colors to brown theme */
        .program-1 { background: linear-gradient(135deg, #996600 0%, #b37400 100%); }
        .program-2 { background: linear-gradient(135deg, #aa7700 0%, #cc8800 100%); }
        .program-3 { background: linear-gradient(135deg, #bb8800 0%, #dd9900 100%); }
        .program-4 { background: linear-gradient(135deg, #cc9900 0%, #eeaa00 100%); }
        .program-5 { background: linear-gradient(135deg, #ddaa00 0%, #ffbb00 100%); }
        .program-6 { background: linear-gradient(135deg, #eebb00 0%, #ffcc00 100%); color: #333 !important; }
        
        .section-title {
            color: var(--dark-brown);
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-brown), var(--accent-brown));
            border-radius: 3px;
            animation: slideInLeft 0.8s ease-out;
        }
        
        .about-section {
            background: #f8fafc;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .about-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(153,102,0,0.05) 0%, transparent 70%);
            animation: rotateIn 1.5s ease-out;
        }
        
        .stats-badge {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }
        
        .stats-badge:hover {
            transform: scale(1.05);
            background: rgba(255,255,255,0.3);
        }
        
        /* Update text colors in stats section */
        .text-primary { color: var(--primary-brown) !important; }
        .text-success { color: #996600 !important; }
        .text-warning { color: #b37400 !important; }
        .text-info { color: #cc9900 !important; }
        
        footer {
            background: #7a5200;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
            animation: slideInLeft 1s ease-out;
        }
        
        /* Update icon colors */
        .fa-3x.text-primary { color: var(--primary-brown) !important; }
        .fa-2x.text-primary { color: var(--primary-brown) !important; }

        /* Search Section Styles */
        .search-section {
            background: #f8f9fa;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .search-section::before {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(153,102,0,0.03) 0%, transparent 70%);
            animation: float 8s ease-in-out infinite;
        }
        
        .search-card {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .search-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(153, 102, 0, 0.15);
        }
        
        /* Dokumen Publik Section */
        .dokumen-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .dokumen-section .fa-6x {
            transition: all 0.5s ease;
            animation: float 4s ease-in-out infinite;
        }
        
        .dokumen-section:hover .fa-6x {
            transform: scale(1.1) rotate(5deg);
            color: var(--primary-brown) !important;
            opacity: 1 !important;
        }
        
        /* Counter Animation */
        .counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-brown);
            transition: all 0.3s ease;
        }
        
        /* Stats Cards */
        .stats-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-card:hover .counter {
            transform: scale(1.1);
            color: var(--dark-brown);
        }
        
        /* CTA Section */
        .cta-section {
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: slideInLeft 3s ease-in-out infinite;
        }
        
        /* Contact Section */
        .contact-card {
            transition: all 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(153, 102, 0, 0.15) !important;
        }
        
        .contact-icon {
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .contact-card:hover .contact-icon {
            transform: rotate(360deg) scale(1.2);
            color: var(--accent-brown) !important;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 0 60px;
                text-align: center;
            }
            
            .section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
        }
        
        @media (max-width: 576px) {
            .hero-section {
                padding: 80px 0 40px;
            }
        }
        
        /* Loading Animation */
        .loading-animation {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .loading-animation.fade-out {
            opacity: 0;
            pointer-events: none;
        }
        
        .loader {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-brown);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Animation -->
    <div class="loading-animation" id="loading">
        <div class="loader"></div>
    </div>

    

    <?php $__env->startSection('title', 'Home'); ?>

    <?php $__env->startSection('content'); ?>

    <!-- Main Content -->
    <main style="padding-top: 0px;">
        <!-- Hero Section -->
        <?php if($heroContent): ?>
        <section id="home" class="hero-section"
            <?php if($heroContent->background_image): ?>
                style="background: linear-gradient(rgba(153, 102, 0, 0.85), rgba(122, 82, 0, 0.85)),
                        url('<?php echo e(asset($heroContent->background_image)); ?>');
                        background-size: cover; background-position: center; background-attachment: fixed;"
            <?php else: ?>
                style="background: linear-gradient(135deg, var(--primary-brown) 0%, var(--dark-brown) 100%);"
            <?php endif; ?>>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 position-relative text-center text-lg-start hero-content">
                        <h1 class="display-4 fw-bold mb-3 text-white" data-aos="fade-up" data-aos-duration="1000"><?php echo e($heroContent->title); ?></h1>
                        <h3 class="h4 mb-4 text-white opacity-90" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"><?php echo e($heroContent->subtitle); ?></h3>
                        <div class="lead mb-4 text-white opacity-90 fw-medium" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <?php echo nl2br(e($heroContent->description)); ?>

                        </div>
                        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                            <a href="<?php echo e($heroContent->cta_link); ?>" class="btn btn-light btn-lg">
                                <?php echo e($heroContent->cta_text); ?> <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 text-center position-relative hero-image">
                        <!-- Area untuk gambar tambahan (gedung, dll) -->
                        <?php if(auth()->check() && auth()->user()->is_admin): ?>
                            <div class="mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
                                <a href="<?php echo e(route('admin.hero.edit', $heroContent->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit me-1"></i>Edit Hero Section
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- Features Section -->
        <section id="features" class="py-5">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="section-title display-5 fw-bold">Fitur Unggulan SPMI</h2>
                    <p class="lead text-muted">Solusi lengkap untuk manajemen mutu pendidikan</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div class="program-card p-4 h-100 text-center">
                            <div class="program-icon program-1 mx-auto mb-3">
                                <i class="fas fa-tasks fa-2x"></i>
                            </div>
                            <h4 class="fw-semibold mb-3">Manajemen Standar</h4>
                            <p class="text-muted">
                                Kelola 12 standar mutu dengan sistem terstruktur untuk penjaminan kualitas pendidikan
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="program-card p-4 h-100 text-center">
                            <div class="program-icon program-2 mx-auto mb-3">
                                <i class="fas fa-clipboard-check fa-2x"></i>
                            </div>
                            <h4 class="fw-semibold mb-3">Audit Digital</h4>
                            <p class="text-muted">
                                Lakukan 8 audit internal dengan tools lengkap dan pelaporan otomatis
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                        <div class="program-card p-4 h-100 text-center">
                            <div class="program-icon program-3 mx-auto mb-3">
                                <i class="fas fa-chart-pie fa-2x"></i>
                            </div>
                            <h4 class="fw-semibold mb-3">Analisis Data</h4>
                            <p class="text-muted">
                                Dashboard analitik untuk monitoring 6 program studi secara real-time
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <div class="program-card p-4 h-100 text-center">
                            <div class="program-icon program-4 mx-auto mb-3">
                                <i class="fas fa-file-contract fa-2x"></i>
                            </div>
                            <h4 class="fw-semibold mb-3">Dokumen Mutu</h4>
                            <p class="text-muted">
                                Kelola 24 dokumen mutu secara terpusat dengan version control yang aman
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                        <div class="program-card p-4 h-100 text-center">
                            <div class="program-icon program-5 mx-auto mb-3">
                                <i class="fas fa-university fa-2x"></i>
                            </div>
                            <h4 class="fw-semibold mb-3">Program Studi</h4>
                            <p class="text-muted">
                                Monitor 6 program studi termasuk Pascasarjana dan pendidikan khusus
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                        <div class="program-card p-4 h-100 text-center">
                            <div class="program-icon program-6 mx-auto mb-3">
                                <i class="fas fa-laptop-code fa-2x"></i>
                            </div>
                            <h4 class="fw-semibold mb-3">LPM Smart Sistem</h4>
                            <p class="text-muted">
                                Sistem terintegrasi untuk Lembaga Penjaminan Mutu yang efisien
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Studi Preview Section -->
        <section id="programs" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="section-title display-5 fw-bold">Program Studi Tersedia</h2>
                    <p class="lead text-muted">Kelola berbagai program studi dalam satu sistem terpadu</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-2 col-md-4 col-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                        <div class="text-center">
                            <div class="program-icon-sm program-1">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <small class="fw-semibold">Ilmu Pendidikan</small>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
                        <div class="text-center">
                            <div class="program-icon-sm program-2">
                                <i class="fas fa-language"></i>
                            </div>
                            <small class="fw-semibold">Pendidikan Bahasa</small>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="300">
                        <div class="text-center">
                            <div class="program-icon-sm program-3">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <small class="fw-semibold">Matematika & Sains</small>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">
                        <div class="text-center">
                            <div class="program-icon-sm program-4">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <small class="fw-semibold">Program Khusus</small>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="500">
                        <div class="text-center">
                            <div class="program-icon-sm program-5">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <small class="fw-semibold">Pascasarjana</small>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="600">
                        <div class="text-center">
                            <div class="program-icon-sm program-6">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <small class="fw-semibold">LPM Smart Sistem</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Preview Section -->
        <section class="py-5">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-4" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
                        <div class="p-3 stats-card">
                            <h3 class="fw-bold text-primary counter" data-target="12">12</h3>
                            <p class="text-muted mb-0">Standar Mutu</p>
                            <small class="text-primary">Terintegrasi</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="p-3 stats-card">
                            <h3 class="fw-bold text-success counter" data-target="8">8</h3>
                            <p class="text-muted mb-0">Audit Internal</p>
                            <small class="text-success">Terselesaikan</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="300">
                        <div class="p-3 stats-card">
                            <h3 class="fw-bold text-warning counter" data-target="24">24</h3>
                            <p class="text-muted mb-0">Dokumen</p>
                            <small class="text-warning">Terkelola</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="400">
                        <div class="p-3 stats-card">
                            <h3 class="fw-bold text-info counter" data-target="6">6</h3>
                            <p class="text-muted mb-0">Program Studi</p>
                            <small class="text-info">Aktif</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section py-5" style="background: linear-gradient(135deg, var(--primary-brown) 0%, var(--dark-brown) 100%); color: white;">
            <div class="container text-center">
                <h2 class="display-6 fw-bold mb-4" data-aos="fade-up" data-aos-duration="1000">Siap Transformasi Digital SPMI?</h2>
                <p class="lead mb-4 opacity-90" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    Bergabung dengan institusi pendidikan yang telah mempercayai SPMI 
                    untuk transformasi digital sistem penjaminan mutu mereka.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <a href="#contact" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="section-title display-5 fw-bold">Hubungi Kami</h2>
                    <p class="lead text-muted">Butuh informasi lebih lanjut? Tim kami siap membantu</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="program-card p-5 contact-card" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="row text-center">
                                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                                    <i class="fas fa-envelope fa-2x text-primary mb-3 contact-icon"></i>
                                    <h5>Email</h5>
                                    <p class="text-muted">info@qtrack-spmi.ac.id</p>
                                </div>
                                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                                    <i class="fas fa-phone fa-2x text-primary mb-3 contact-icon"></i>
                                    <h5>Telepon</h5>
                                    <p class="text-muted">+62 21 1234 5678</p>
                                </div>
                                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                                    <i class="fas fa-clock fa-2x text-primary mb-3 contact-icon"></i>
                                    <h5>Jam Operasional</h5>
                                    <p class="text-muted">Senin - Jumat, 08:00 - 17:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php $__env->stopSection(); ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            mirror: false,
            duration: 1000,
            easing: 'ease-in-out'
        });

        // Loading Animation
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading').classList.add('fade-out');
            }, 500);
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth Scroll for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const count = parseInt(counter.innerText);
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(() => animateCounter(counter), 1);
            } else {
                counter.innerText = target;
            }
        };

        // Intersection Observer for counters
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    animateCounter(counter);
                    observer.unobserve(counter);
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            observer.observe(counter);
        });

        // Parallax Effect for Hero Section
        window.addEventListener('scroll', () => {
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                const scrolled = window.pageYOffset;
                const rate = scrolled * 0.5;
                heroSection.style.backgroundPosition = `center ${rate}px`;
            }
        });

        // Hover Effect for Cards
        const cards = document.querySelectorAll('.program-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Typing Effect for Hero Title (Optional)
        if (document.querySelector('.hero-section h1')) {
            const heroTitle = document.querySelector('.hero-section h1');
            const originalText = heroTitle.innerText;
            
            // Uncomment untuk mengaktifkan typing effect
            /*
            heroTitle.innerText = '';
            let i = 0;
            const typeWriter = () => {
                if (i < originalText.length) {
                    heroTitle.innerText += originalText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            };
            typeWriter();
            */
        }

        // Button Ripple Effect
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                this.appendChild(ripple);
                
                const x = e.clientX - e.target.offsetLeft;
                const y = e.clientY - e.target.offsetTop;
                
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Scroll to Top Button
        const scrollToTop = () => {
            const scrollButton = document.createElement('button');
            scrollButton.innerHTML = '<i class="fas fa-arrow-up"></i>';
            scrollButton.classList.add('scroll-to-top');
            scrollButton.style.cssText = `
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: var(--primary-brown);
                color: white;
                border: none;
                cursor: pointer;
                display: none;
                z-index: 99;
                transition: all 0.3s ease;
                box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            `;
            
            document.body.appendChild(scrollButton);
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollButton.style.display = 'block';
                } else {
                    scrollButton.style.display = 'none';
                }
            });
            
            scrollButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            scrollButton.addEventListener('mouseenter', () => {
                scrollButton.style.transform = 'scale(1.1)';
                scrollButton.style.boxShadow = '0 5px 20px rgba(153, 102, 0, 0.4)';
            });
            
            scrollButton.addEventListener('mouseleave', () => {
                scrollButton.style.transform = 'scale(1)';
                scrollButton.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
            });
        };
        
        // Uncomment untuk mengaktifkan scroll to top button
        // scrollToTop();
    </script>

    <style>
        /* Additional Animations */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-brown);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-brown);
        }
        
        /* Fade In Animation */
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Slide Up Animation */
        .slide-up {
            animation: slideUp 0.8s ease-out;
        }
        
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* Zoom In Animation */
        .zoom-in {
            animation: zoomIn 0.6s ease-out;
        }
        
        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        /* Pulse Animation */
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* Shake Animation */
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        /* Bounce Animation */
        .bounce {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-30px); }
            60% { transform: translateY(-15px); }
        }
        
        /* Flip Animation */
        .flip {
            animation: flip 1s ease-in-out;
        }
        
        @keyframes flip {
            from {
                transform: perspective(400px) rotateY(0);
            }
            to {
                transform: perspective(400px) rotateY(360deg);
            }
        }
        
        /* Gradient Animation */
        .gradient-animation {
            background: linear-gradient(270deg, var(--primary-brown), var(--accent-brown), var(--secondary-brown));
            background-size: 600% 600%;
            animation: gradient 10s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Text Shadow Animation */
        .text-shadow-animation {
            animation: textShadow 2s ease-in-out infinite;
        }
        
        @keyframes textShadow {
            0% { text-shadow: 0 0 0 rgba(153, 102, 0, 0); }
            50% { text-shadow: 2px 2px 4px rgba(153, 102, 0, 0.3); }
            100% { text-shadow: 0 0 0 rgba(153, 102, 0, 0); }
        }
        
        /* Border Animation */
        .border-animation {
            position: relative;
        }
        
        .border-animation::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border: 2px solid var(--primary-brown);
            border-radius: inherit;
            animation: borderPulse 2s linear infinite;
        }
        
        @keyframes borderPulse {
            0% { opacity: 0; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.05); }
            100% { opacity: 0; transform: scale(1); }
        }
        
        /* Loading Animation Enhancement */
        .loading-animation {
            background: linear-gradient(135deg, #fff, #f8f9fa);
        }
        
        .loader {
            border-width: 4px;
            border-color: #f3f3f3;
            border-top-color: var(--primary-brown);
            border-right-color: var(--secondary-brown);
            border-bottom-color: var(--accent-brown);
            width: 60px;
            height: 60px;
        }
    </style>
</body>
</html>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/landing/index.blade.php ENDPATH**/ ?>