<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#" target="_blank">Ponpes App</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#" target="_blank">PA</a>
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
            <li class="menu-header">Keuangan</li>
            <li class="{{ (request()->routeIs('buku-kas*')) ? 'active' : '' }}">
                <a href="{{ route('buku-kas.index') }}" class="nav-link">
                    <i class="fas fa-book-open"></i><span>Buku Kas</span>
                </a>
            </li>
            <li class="{{ (request()->routeIs('syahriah*')) ? 'active' : '' }}">
                <a href="{{ route('syahriah.index') }}" class="nav-link">
                    <i class="fas fa-file-invoice"></i><span>Syahriah (SPP)</span>
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
            <li class="menu-header">User</li>
            <li class="{{ (request()->routeIs('pengguna*')) ? 'active' : '' }}">
                <a href="{{ route('pengguna.index') }}" class="nav-link">
                    <i class="fas fa-user-cog"></i><span>Data Pengguna</span>
                </a>
            </li>
            <li class="menu-header">Logs</li>
            <li class="{{ (request()->routeIs('activity.index')) ? 'active' : '' }}">
                <a href="{{ route('activity.index') }}" class="nav-link">
                    <i class="fas fa-history"></i><span>Log Aktivitas</span>
                </a>
            </li>
            {{-- <li class="{{ (request()->routeIs('students*')) ? 'active' : '' }}">
                <a href="{{ route('students.index') }}" class="nav-link">
                    <i class="fas fa-user"></i><span>Students</span>
                </a>
            </li>
            <li class="{{ (request()->routeIs('getMajor')) ? 'active' : '' }}">
                <a href="{{ route('getMajor') }}" class="nav-link">
                    <i class="fas fa-address-book"></i><span>Consume API</span>
                </a>
            </li> --}}
        </ul>
    </aside>
</div>
