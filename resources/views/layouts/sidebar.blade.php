@php
    use App\Models\Dokumen;
    use Illuminate\Support\Facades\Route;

    $user = auth()->user();
    $role = $user ? strtolower($user->role) : null;
    $isAdmin = $role === 'admin';
    $isUser = $role === 'user';
    
    function routeExists($routeName) {
        return Route::has($routeName);
    }
    
    // Dashboard route based on role
    if ($isAdmin) {
        $dashboardRoute = routeExists('admin.dashboard') ? route('admin.dashboard') : '#';
    } else {
        $dashboardRoute = routeExists('user.dashboard') ? route('user.dashboard') : '#';
    }
    
    // Hitung total dokumen user
    $userDocumentsCount = 0;
    if ($isUser) {
        try {
            $userDocumentsCount = $user->dokumens()->count();
        } catch (\Exception $e) {
            $userDocumentsCount = 0;
        }
    }
@endphp

<div class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <img src="{{ asset('images/photos/25600_Logo-IKIP-warna.png') }}" 
                 alt="IKIP Logo" 
                 class="sidebar-logo">
            <div class="sidebar-brand-text">
                <h5>SPMI</h5>
                <small>Q-TRACK Digital</small>
            </div>
        </div>
        <div class="sidebar-user-role">
            @if($isAdmin)
                <span class="role-badge admin">Administrator</span>
            @else
                <span class="role-badge user">User</span>
            @endif
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            
            {{-- DASHBOARD UNTUK SEMUA --}}
            <li class="nav-item">
                <a href="{{ $dashboardRoute }}" class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- ========== MENU ADMIN ========== --}}
            @if($isAdmin)
            
            <li class="nav-section">MASTER DATA</li>
            
            {{-- Unit Kerja --}}
            @if(routeExists('admin.settings.unit-kerja.index'))
            <li class="nav-item">
                <a href="{{ route('admin.settings.unit-kerja.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.settings.unit-kerja.*') ? 'active' : '' }}">
                    <i class="fas fa-building"></i>
                    <span>Unit Kerja</span>
                </a>
            </li>
            @endif

            {{-- IKU --}}
            @if(routeExists('admin.settings.iku.index'))
            <li class="nav-item">
                <a href="{{ route('admin.settings.iku.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.settings.iku.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>IKU</span>
                </a>
            </li>
            @endif

            <li class="nav-section">MANAJEMEN</li>
            
            {{-- Kelola Akun/User --}}
            @if(routeExists('admin.users.index'))
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Kelola Akun</span>
                </a>
            </li>
            @endif

            {{-- Kelola Dokumen --}}
            @if(routeExists('admin.dokumen.index'))
            <li class="nav-item">
                <a href="{{ route('admin.dokumen.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.dokumen.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Kelola Dokumen</span>
                </a>
            </li>
            @endif

            <li class="nav-section">KONTEN</li>
            
            {{-- Kelola Berita --}}
            @if(routeExists('admin.berita.index'))
            <li class="nav-item">
                <a href="{{ route('admin.berita.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Kelola Berita</span>
                </a>
            </li>
            @endif

            {{-- Kelola Jadwal --}}
            @if(routeExists('admin.jadwal.index'))
            <li class="nav-item">
                <a href="{{ route('admin.jadwal.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Kelola Jadwal</span>
                </a>
            </li>
            @endif

            @endif {{-- End Admin --}}

            {{-- ========== MENU USER ========== --}}
            @if($isUser)
            
            <li class="nav-section">DOKUMEN SAYA</li>
            
            {{-- Upload Dokumen --}}
            @if(routeExists('user.upload-dokumen.create'))
            <li class="nav-item">
                <a href="{{ route('user.upload-dokumen.create') }}" 
                   class="nav-link {{ request()->routeIs('user.upload.create') ? 'active' : '' }}">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Upload Dokumen</span>
                </a>
            </li>
            @endif

            {{-- Daftar Dokumen Saya --}}
            @if(routeExists('user.dokumen-saya'))
            <li class="nav-item">
                <a href="{{ route('user.dokumen-saya') }}" 
                   class="nav-link {{ request()->routeIs('user.upload.dokumen-saya') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span>Dokumen Saya</span>
                    @if($userDocumentsCount > 0)
                        <span class="badge">{{ $userDocumentsCount }}</span>
                    @endif
                </a>
            </li>
            @endif

            @endif {{-- End User --}}

            {{-- ========== MENU SPMI UNTUK ADMIN ========== --}}
            @if($isAdmin)
            <li class="nav-section">SIKLUS PPEPP</li>
            
            {{-- Penetapan --}}
            @if(routeExists('admin.spmi.penetapan.index'))
            <li class="nav-item">
                <a href="{{ route('admin.spmi.penetapan.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.spmi.penetapan.*') ? 'active' : '' }}">
                    <i class="fas fa-pen-fancy"></i>
                    <span>Penetapan</span>
                </a>
            </li>
            @endif

            {{-- Pelaksanaan --}}
            @if(routeExists('admin.spmi.pelaksanaan.index'))
            <li class="nav-item">
                <a href="{{ route('admin.spmi.pelaksanaan.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.spmi.pelaksanaan.*') ? 'active' : '' }}">
                    <i class="fas fa-play"></i>
                    <span>Pelaksanaan</span>
                </a>
            </li>
            @endif

            {{-- Evaluasi --}}
            @if(routeExists('admin.spmi.evaluasi.index'))
            <li class="nav-item">
                <a href="{{ route('admin.spmi.evaluasi.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.spmi.evaluasi.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-simple"></i>
                    <span>Evaluasi</span>
                </a>
            </li>
            @endif

            {{-- Pengendalian --}}
            @if(routeExists('admin.spmi.pengendalian.index'))
            <li class="nav-item">
                <a href="{{ route('admin.spmi.pengendalian.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.spmi.pengendalian.*') ? 'active' : '' }}">
                    <i class="fas fa-sliders"></i>
                    <span>Pengendalian</span>
                </a>
            </li>
            @endif

            {{-- Peningkatan --}}
            @if(routeExists('admin.spmi.peningkatan.index'))
            <li class="nav-item">
                <a href="{{ route('admin.spmi.peningkatan.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.spmi.peningkatan.*') ? 'active' : '' }}">
                    <i class="fas fa-arrow-up"></i>
                    <span>Peningkatan</span>
                </a>
            </li>
            @endif

            {{-- Akreditasi --}}
            @if(routeExists('admin.spmi.akreditasi.index'))
            <li class="nav-item">
                <a href="{{ route('admin.spmi.akreditasi.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.spmi.akreditasi.*') ? 'active' : '' }}">
                    <i class="fas fa-star"></i>
                    <span>Akreditasi</span>
                </a>
            </li>
            @endif

            @endif {{-- End Admin SPMI --}}

            <li class="nav-section">PROFIL</li>
            
            {{-- Edit Profile --}}
            @if(routeExists('profile.edit'))
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" 
                   class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fas fa-user-cog"></i>
                    <span>Edit Profil</span>
                </a>
            </li>
            @endif
        </ul>
    </div>

    
    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
                <form id="logout-form" action="{{ routeExists('logout') ? route('logout') : '#' }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>