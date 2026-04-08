@extends('layouts.admin')

@section('title', 'Add User to ' . ($tenant->name ?? $tenant->id))

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <a href="{{ route('admin.tenants.users.index', $tenant->id) }}" class="btn btn-secondary btn-sm" style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Add User to Tenant</h1>
    </div>
</div>

<div class="card" style="max-width: 700px;">
    <div class="card-header">
        Create New Credentials
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tenants.users.store', $tenant->id) }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Full Name <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. John Doe" required>
            </div>
    
            <div class="form-group">
                <label for="email" class="form-label">Email Address <span style="color: red;">*</span></label>
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #f1f5f9; border: 1px solid var(--border-color); border-right: none; padding: 0.75rem 1rem; border-top-left-radius: 6px; border-bottom-left-radius: 6px; color: var(--text-muted);">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="john@example.com" required style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
    
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('admin.tenants.users.index', $tenant->id) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </form>
    </div>
</div>
@endsection
