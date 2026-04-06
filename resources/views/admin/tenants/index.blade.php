@extends('layouts.admin')

@section('title', 'Manage Tenants')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Tenants</h1>
    <a href="{{ route('admin.tenants.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add New Tenant
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        @if($tenants->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Organization Name</th>
                        <th>Domains</th>
                        <th>Created Date</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                        <tr>
                            <td>
                                <span class="badge">{{ $tenant->id }}</span>
                            </td>
                            <td style="font-weight: 500; color: var(--text-dark);">
                                {{ $tenant->data['name'] ?? 'N/A' }}
                            </td>
                            <td>
                                @foreach($tenant->domains as $domain)
                                    <div style="display: flex; align-items: center; gap: 6px;">
                                        <i class="fa-solid fa-globe" style="color: var(--secondary); font-size: 0.8rem;"></i>
                                        <a href="http://{{ $domain->domain }}:8000" target="_blank" style="color: var(--primary); text-decoration: none; font-size: 0.9rem;">
                                            {{ $domain->domain }}
                                        </a>
                                    </div>
                                @endforeach
                                @if($tenant->domains->isEmpty())
                                    <span style="color: var(--text-muted); font-size: 0.9rem;">No domains attached</span>
                                @endif
                            </td>
                            <td style="font-size: 0.9rem;">
                                {{ $tenant->created_at?->format('M d, Y') }}
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.tenants.edit', $tenant->id) }}" class="btn btn-secondary btn-sm" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="POST" onsubmit="return confirm('WARNING: Are you absolutely sure you want to delete this tenant? All associated data will be lost.');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 4rem 2rem;">
                <div style="background-color: #f1f5f9; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fa-solid fa-boxes-stacked" style="font-size: 2rem; color: var(--secondary);"></i>
                </div>
                <h3 style="margin-bottom: 0.5rem; color: var(--text-dark);">No Tenants Yet</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem; max-width: 400px; margin-left: auto; margin-right: auto;">Get started by creating your first tenant. A tenant acts as a separate instance of your SaaS for a customer.</p>
                <a href="{{ route('admin.tenants.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Create First Tenant
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
