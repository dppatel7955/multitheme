<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class TenantAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check tenant initialized
        if (!tenant()) {
            return redirect('/'); // or abort(404)
        }

        // Check authentication
        if (!Auth::check()) {
            return redirect()->route('tenant.login');
        }

        return $next($request);
    }
}
