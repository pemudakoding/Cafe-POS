<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar mr-1">
                        <img src="{{ Auth::user()->photo }}" alt="" srcset="">
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">{{ Auth::user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <form action="{{ route('auth.logout') }}" id="form" method="POST">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="javascript:void(0)"
                        onclick="document.querySelector('form').submit()"><i data-feather="log-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>