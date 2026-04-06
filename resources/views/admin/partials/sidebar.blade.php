<aside class="sidebar">
    <div class="sidebar-header">
        <h2><i class="fa-solid fa-layer-group" style="margin-right: 8px; color: var(--primary)"></i> SaaS Admin</h2>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
        </li>
        @if(auth()->check() && auth()->user()->is_super_admin)
        <li>
            <a href="{{ route('admin.tenants.index') }}" class="{{ request()->routeIs('admin.tenants.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users-viewfinder"></i> Manage Tenants
            </a>
        </li>
        @endif
    </ul>
    <div class="sidebar-footer">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #cbd5e1; text-decoration: none; display: flex; align-items: center; font-weight: 500;">
            <i class="fa-solid fa-arrow-right-from-bracket" style="margin-right: 12px;"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
