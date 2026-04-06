@extends('layouts.admin')

@section('title', 'Manage Tenants')

@section('content')
<div class="flex-between" style="margin-bottom: 2rem;">
    <h1>Tenants</h1>
    <a href="{{ route('admin.tenants.create') }}" class="btn btn-primary">+ Add New Tenant</a>
</div>

<div class="glass-panel">
    @if($tenants->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Domain</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenants as $tenant)
                    <tr>
                        <td style="font-family: monospace; color: var(--text-muted);">{{ $tenant->id }}</td>
                        <td>{{ $tenant->data['name'] ?? 'N/A' }}</td>
                        <td>
                            @foreach($tenant->domains as $domain)
                                <a href="http://{{ $domain->domain }}:8000" target="_blank" style="color: var(--accent); text-decoration: none;">
                                    {{ $domain->domain }}
                                </a><br>
                            @endforeach
                            @if($tenant->domains->isEmpty())
                                <span style="color: var(--text-muted)">No domain</span>
                            @endif
                        </td>
                        <td style="color: var(--text-muted); font-size: 0.9rem;">{{ $tenant->created_at?->format('M d, Y') }}</td>
                        <td>
                            <div class="flex-gap">
                                <a href="{{ route('admin.tenants.edit', $tenant->id) }}" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Edit</a>
                                <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tenant? All associated data might be affected.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
            <svg style="width: 64px; height: 64px; margin: 0 auto 1rem; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <h3>No Tenants Found</h3>
            <p>You haven't setup any tenants yet.</p>
        </div>
    @endif
</div>
@endsection
