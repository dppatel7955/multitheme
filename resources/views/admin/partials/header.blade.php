<header class="header">
    <div class="header-search">
    </div>
    <div class="header-user">
        <div style="text-align: right;">
            <div style="font-weight: 600; font-size: 0.9rem; color: var(--text-dark);">
                {{ auth()->user()->name ?? 'Super Admin' }}
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted);">
                {{ auth()->user()->email ?? 'admin@saas.com' }}
            </div>
        </div>
        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name ?? 'S A', 0, 2)) }}
        </div>
    </div>
</header>