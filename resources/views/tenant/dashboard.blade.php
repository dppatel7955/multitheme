@extends('tenant.layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 style="margin: 0; font-size: 1.5rem;">Dashboard Dashboard</h1>
    <div style="background-color: var(--surface); padding: 0.5rem 1rem; border-radius: 999px; border: 1px solid var(--border); font-size: 0.85rem; font-weight: 500; font-family: monospace;">
        Tenant ID: <span style="color: var(--brand-color);">{{ tenant('id') }}</span>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
    <!-- Welcome Card -->
    <div class="card" style="grid-column: 1 / -1;">
        <div style="display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 80px; height: 80px; background-color: #f0f9ff; color: var(--brand-color); border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 2rem;">
                <i class="fa-solid fa-hand-sparkles"></i>
            </div>
            <div>
                <h2 style="margin: 0 0 0.5rem 0; font-size: 1.25rem;">Welcome, {{ auth()->user()->name }}!</h2>
                <p style="margin: 0; color: var(--text-muted); line-height: 1.5;">You are securely logged into the <strong>{{ tenant()->data['name'] ?? tenant('id') }}</strong> organization workspace. Your data is fully isolated from all other tenants on this platform.</p>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="card" style="padding: 1.5rem;">
        <p style="margin: 0 0 0.5rem 0; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">Your Projects</p>
        <h3 style="margin: 0; font-size: 2rem;">0</h3>
        <p style="margin: 0.5rem 0 0 0; color: var(--text-muted); font-size: 0.85rem;"><i class="fa-solid fa-arrow-up" style="color: #10b981; margin-right: 4px;"></i> 0% since last month</p>
    </div>

    <div class="card" style="padding: 1.5rem;">
        <p style="margin: 0 0 0.5rem 0; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">Active Users</p>
        <h3 style="margin: 0; font-size: 2rem;">1</h3>
        <p style="margin: 0.5rem 0 0 0; color: var(--text-muted); font-size: 0.85rem;"><i class="fa-solid fa-check" style="color: #10b981; margin-right: 4px;"></i> Just you for now</p>
    </div>
</div>
@endsection
