<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
                <img src="{{ asset('storage/image/sidebar.webp') }}" alt="navbar brand"
                    class="navbar-brand" height="30" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            @if (Auth::user()->role === 'administrator')
                @include('dashboard.partials.link-sidebar-administrator')
            @elseif(Auth::user()->role === 'staf_administrasi')
                @include('dashboard.partials.link-sidebar-staf-administrasi')
            @elseif(Auth::user()->role === 'staf_pengajar')
                @include('dashboard.partials.link-sidebar-staf-pengajar')
            @elseif(Auth::user()->role === 'siswa')
                @include('dashboard.partials.link-sidebar-siswa')
            @elseif(Auth::user()->role === 'user')
                @include('dashboard.partials.link-sidebar-user')
            @endif
        </div>
    </div>

</div>
