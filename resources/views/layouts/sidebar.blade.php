<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.apars.*') ? 'active' : '' }}" href="{{ route('admin.apars.index') }}">
                    <i class="fas fa-fire-extinguisher me-2"></i>
                    Manajemen APAR
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users-cog me-2"></i>
                    Manajemen Pengguna
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.reports.inspeksi.*') ? 'active' : '' }}" href="{{ route('admin.reports.inspeksi.index') }}">
                    <i class="fas fa-file-excel me-2"></i>
                    Laporan Inspeksi
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Informasi</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-info-circle me-2"></i>
                    Bantuan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Keluar
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100; /* Behind the navbar */
        padding: 48px 0 0; /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #999;
    }

    .sidebar .nav-link.active {
        color: #007bff;
    }

    .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
    }

    .main-content {
        margin-left: 17%;
    }
</style>