@extends('layouts.admin')

@section('title', 'Manage Users for ' . ($tenant->name ?? $tenant->id))

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Users for <span style="color: var(--primary);">{{ $tenant->name ?? $tenant->id }}</span></h1>
    </div>
    
    <a href="{{ route('admin.tenants.users.create', $tenant->id) }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Add User
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        @if($users->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Joined Date</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td style="font-weight: 500; color: var(--text-dark);">
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td style="font-size: 0.9rem;">
                                {{ $user->created_at?->format('M d, Y') }}
                            </td>
                            <td style="text-align: right;">
                                <form action="{{ route('admin.tenants.users.destroy', [$tenant->id, $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this user from the tenant?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete User">
                                        <i class="fa-solid fa-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 4rem 2rem;">
                <div style="background-color: #f1f5f9; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fa-solid fa-user-slash" style="font-size: 2rem; color: var(--secondary);"></i>
                </div>
                <h3 style="margin-bottom: 0.5rem; color: var(--text-dark);">No Users Built In</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem; max-width: 400px; margin-left: auto; margin-right: auto;">This tenant currently has no users. Create a user to allow them to log into the tenant dashboard.</p>
                <a href="{{ route('admin.tenants.users.create', $tenant->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-user-plus"></i> Add First User
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
