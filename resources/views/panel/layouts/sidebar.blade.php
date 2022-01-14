<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fab fa-laravel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LARAVEL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ str_contains(url()->current(), route('panel.dashboard')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('panel.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @if (auth()->user()->is_admin)
        <!-- Nav Item - User -->
        <li class="nav-item {{ str_contains(url()->current(), route('panel.user')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.user') }}">
                <i class="fas fa-users"></i>
                <span>Usuários</span>
            </a>
        </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
