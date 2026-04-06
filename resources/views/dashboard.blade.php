@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Welcome Card -->
    <div class="card" style="grid-column: 1 / -1;">
        <div class="card-body" style="display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 80px; height: 80px; background-color: #e0e7ff; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                <i class="fa-solid fa-hand-wave" style="color: var(--primary); font-size: 2.5rem;"></i>
            </div>
            <div>
                <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: var(--text-dark);">Welcome back, {{ auth()->user()->name ?? 'Administrator' }}!</h2>
                <p style="margin: 0; color: var(--text-muted); line-height: 1.5;">Here is what's happening with your platform today. You have successfully logged into the central domain.</p>
            </div>
        </div>
    </div>

    <!-- Stats Card Placeholder (If Super Admin) -->
    @if(auth()->user()?->is_super_admin)
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="margin: 0 0 0.5rem 0; color: var(--text-muted); font-size: 0.875rem; font-weight: 500; text-transform: uppercase;">Total Tenants</p>
                    <h3 style="margin: 0; font-size: 2rem; color: var(--text-dark);">{{ \App\Models\Tenant::count() }}</h3>
                </div>
                <div style="background-color: #f1f5f9; padding: 0.75rem; border-radius: 0.5rem;">
                    <i class="fa-solid fa-users-viewfinder" style="color: var(--primary); font-size: 1.25rem;"></i>
                </div>
            </div>
            <div style="margin-top: 1rem;">
                <a href="{{ route('admin.tenants.index') }}" style="color: var(--primary); text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                    Manage Tenants <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; margin-left: 4px;"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
