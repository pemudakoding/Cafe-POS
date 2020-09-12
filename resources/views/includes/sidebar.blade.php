<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <h4>Cafe Tutuk</h4>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu Utama</li>

                <li class="sidebar-item @yield('dashboard')">
                    <a href="{{ route('dashboard.index') }}" class="sidebar-link">
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item @yield('menu')">
                    <a href="{{ route('menu.index') }}" class="sidebar-link">
                        <i data-feather="pie-chart" width="20"></i>
                        <span>Manajemen Menu</span>
                    </a>
                </li>

                <li class="sidebar-item @yield('ingredients')">
                    <a href="{{ route('ingredients.index') }}" class="sidebar-link">
                        <i data-feather="box" width="20"></i>
                        <span>Manajemen Bahan-Bahan</span>
                    </a>
                </li>
                <li class="sidebar-item @yield('user')">
                    <a href="{{ route('user.index') }}" class="sidebar-link @yield('user')">
                        <i data-feather="user" width="20"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>