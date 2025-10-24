<ul class="nav nav-secondary">
    <li class="nav-item {{ request()->is('dashboard/user/*') ? '' : 'active' }}">
        <a href="{{ route('dashboard.user.index') }}" class="collapsed">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
</ul>
