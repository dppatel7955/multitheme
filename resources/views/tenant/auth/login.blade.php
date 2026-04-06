@extends('tenant.layouts.app')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <div style="width: 50px; height: 50px; background-color: #e0f2fe; color: var(--brand-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem;">
            <i class="fa-solid fa-briefcase"></i>
        </div>
        <h1>Welcome Back</h1>
        <p>Sign in to <strong>{{ tenant()->data['name'] ?? tenant('id') }}</strong></p>
    </div>

    @if ($errors->any())
        <div class="alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('tenant.login') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn">Sign In to Dashboard</button>
    </form>
    
    <div style="text-align: center; margin-top: 1.5rem; font-size: 0.8rem; color: var(--text-muted);">
        Powered by Multi-Tenant Engine
    </div>
</div>
@endsection
