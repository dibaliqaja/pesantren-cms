<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#" target="_blank">Pondok App</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#" target="_blank">PA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Starter</li>
            <li class="{{ (request()->routeIs('santri*')) ? 'active' : '' }}">
                <a href="{{ route('santri.index') }}" class="nav-link">
                    <i class="fas fa-users"></i><span>Data Santri</span>
                </a>
            </li>
            <li class="{{ (request()->routeIs('buku-kas*')) ? 'active' : '' }}">
                <a href="{{ route('buku-kas.index') }}" class="nav-link">
                    <i class="fas fa-book-open"></i><span>Buku Kas</span>
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
