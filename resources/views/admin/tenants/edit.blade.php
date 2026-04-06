@extends('layouts.admin')

@section('title', 'Edit Tenant')

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Edit Tenant</h1>
    </div>
</div>

<div class="card" style="max-width: 700px;">
    <div class="card-header">
        Tenant Details: <span style="color: var(--primary);">{{ $tenant->id }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Internal ID <i class="fa-solid fa-lock" style="font-size: 0.75rem; color: var(--text-muted); margin-left: 4px;"></i></label>
                <input type="text" class="form-control" value="{{ $tenant->id }}" disabled>
                <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.4rem; display: block;">The internal ID cannot be modified once created.</small>
            </div>
    
            <div class="form-group">
                <label for="name" class="form-label">Organization Name <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $tenant->data['name'] ?? '') }}" required>
            </div>
    
            <div class="form-group">
                <label for="domain" class="form-label">Primary Domain <span style="color: red;">*</span></label>
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #f1f5f9; border: 1px solid var(--border-color); border-right: none; padding: 0.75rem 1rem; border-top-left-radius: 6px; border-bottom-left-radius: 6px; color: var(--text-muted);">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <input type="text" id="domain" name="domain" class="form-control" value="{{ old('domain', $tenant->domains->first()?->domain) }}" required style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                </div>
            </div>
    
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
