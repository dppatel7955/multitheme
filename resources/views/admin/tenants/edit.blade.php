@extends('layouts.admin')

@section('title', 'Edit Tenant')

@section('content')
<div class="flex-between" style="margin-bottom: 2rem;">
    <h1>Edit Tenant: {{ $tenant->id }}</h1>
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

    <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Tenant ID (Cannot be changed)</label>
            <input type="text" class="form-control" value="{{ $tenant->id }}" disabled style="opacity: 0.6; cursor: not-allowed;">
        </div>

        <div class="form-group">
            <label for="name">Tenant Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $tenant->data['name'] ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="domain">Primary Domain Name</label>
            <input type="text" id="domain" name="domain" class="form-control" value="{{ old('domain', $tenant->domains->first()?->domain) }}" required>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection
