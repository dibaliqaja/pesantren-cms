<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#" target="_blank">Pesantren CMS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#" target="_blank">CMS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Starter</li>
            <li class="{{ (request()->routeIs('home*')) ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="fas fa-home"></i><span>Home</span>
                </a>
            </li>
            <li class="{{ (request()->routeIs('santri*')) ? 'active' : '' }}">
                <a href="{{ route('santri.index') }}" class="nav-link">
                    <i class="fas fa-users"></i><span>Data Santri</span>
                </a>
            </li>
            <li class="menu-header">User</li>
            <li class="{{ (request()->routeIs('pengguna*')) ? 'active' : '' }}">
                <a href="{{ route('pengguna.index') }}" class="nav-link">
                    <i class="fas fa-user-cog"></i><span>Data Pengguna</span>
                </a>
            </li>
            <li class="menu-header">Keuangan</li>
            <li class="{{ (request()->routeIs('biaya*')) ? 'active' : '' }}">
                <a href="{{ route('biaya.index') }}" class="nav-link">
                    <i class="far fa-file-alt"></i><span>Biaya Pembayaran</span>
                </a>
            </li>
            <li class="dropdown {{ (request()->routeIs('syahriah*') || request()->routeIs('registration*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-invoice"></i> <span>Pembayaran</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->routeIs('registration*')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('registration.index') }}">Pendaftaran Baru</a>
                    </li>
                    <li class="{{ (request()->routeIs('syahriah*')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('syahriah.index') }}">Syahriah (SPP)</a>
                    </li>
                </ul>
            </li>
            <li class="{{ (request()->routeIs('buku-kas*')) ? 'active' : '' }}">
                <a href="{{ route('buku-kas.index') }}" class="nav-link">
                    <i class="fas fa-book-open"></i><span>Buku Kas</span>
                </a>
            </li>
            <li class="menu-header">Administrasi</li>
            <li class="{{ (request()->routeIs('surat-masuk*')) ? 'active' : '' }}">
                <a href="{{ route('surat-masuk.index') }}" class="nav-link">
                    <i class="fas fa-envelope"></i><span>Surat Masuk</span>
                </a>
            </li>
            <li class="{{ (request()->routeIs('surat-keluar*')) ? 'active' : '' }}">
                <a href="{{ route('surat-keluar.index') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text"></i><span>Surat Keluar</span>
                </a>
            </li>
            <li class="menu-header">Logs</li>
            <li class="{{ (request()->routeIs('logs.index')) ? 'active' : '' }}">
                <a href="{{ route('logs.index') }}" class="nav-link">
                    <i class="fas fa-history"></i><span>Log Aktivitas</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
