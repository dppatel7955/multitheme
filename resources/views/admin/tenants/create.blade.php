@extends('layouts.admin')

@section('title', 'Add New Tenant')

@section('content')
<div class="flex-between" style="margin-bottom: 2rem;">
    <h1>Add New Tenant</h1>
    <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary">← Back to List</a>
</div>

<div class="glass-panel" style="max-width: 600px; margin: 0 auto;">
    @if ($errors->any())
        <div class="alert-success" style="background-color: rgba(239, 68, 68, 0.1); color: var(--danger); border-color: rgba(239, 68, 68, 0.2);">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tenants.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Tenant Name (Company/Organization)</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Acme Corp" required>
        </div>

        <div class="form-group">
            <label for="id">Tenant ID (Unique Identifier)</label>
            <input type="text" id="id" name="id" class="form-control" value="{{ old('id') }}" placeholder="e.g. acme" required>
            <small style="color: var(--text-muted); margin-top: 0.5rem; display: block;">Letters, numbers, and dashes only.</small>
        </div>

        <div class="form-group">
            <label for="domain">Domain Name</label>
            <input type="text" id="domain" name="domain" class="form-control" value="{{ old('domain') }}" placeholder="e.g. acme.localhost" required>
            <small style="color: var(--text-muted); margin-top: 0.5rem; display: block;">The full domain or subdomain (e.g. client1.yourdomain.com).</small>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn btn-primary">Create Tenant</button>
        </div>
    </form>
</div>
@endsection
