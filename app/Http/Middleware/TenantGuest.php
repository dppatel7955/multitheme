<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class TenantGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check tenant exists
        if (!tenant()) {
            return redirect('/');
        }

        // If already logged in → redirect to dashboard
        if (Auth::check()) {
            return redirect()->route('tenant.dashboard');
        }

        return $next($request);
    }
}
