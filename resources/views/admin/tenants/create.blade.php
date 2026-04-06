@extends('layouts.admin')

@section('title', 'Add New Tenant')

@section('content')
<div class="page-header">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Add New Tenant</h1>
    </div>
</div>

<div class="card" style="max-width: 700px;">
    <div class="card-header">
        Tenant Details
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tenants.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Organization Name <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Acme Corporation" required>
            </div>
    
            <div class="form-group">
                <label for="id" class="form-label">Tenant ID (Unique Identifier) <span style="color: red;">*</span></label>
                <input type="text" id="id" name="id" class="form-control" value="{{ old('id') }}" placeholder="e.g. acme" required>
                <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.4rem; display: block;">This acts as the internal ID for the database schema/scoping. Suggest lowercase, no spaces.</small>
            </div>
    
            <div class="form-group">
                <label for="domain" class="form-label">Primary Domain <span style="color: red;">*</span></label>
                <div style="display: flex; align-items: center;">
                    <div style="background-color: #f1f5f9; border: 1px solid var(--border-color); border-right: none; padding: 0.75rem 1rem; border-top-left-radius: 6px; border-bottom-left-radius: 6px; color: var(--text-muted);">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <input type="text" id="domain" name="domain" class="form-control" value="{{ old('domain') }}" placeholder="e.g. acme.localhost" required style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                </div>
            </div>
    
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Tenant</button>
            </div>
        </form>
    </div>
</div>
@endsection
