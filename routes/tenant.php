<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });

    // Guest routes
    Route::middleware('tenant.guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Tenant\AuthController::class, 'showLoginForm'])->name('tenant.login');
        Route::post('/login', [\App\Http\Controllers\Tenant\AuthController::class, 'login']);
    });

    // Authenticated routes
    Route::middleware('tenant.auth')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Tenant\AuthController::class, 'logout'])->name('tenant.logout');
        
        Route::get('/dashboard', function () {
            return view('tenant.dashboard');
        })->name('tenant.dashboard');
    });
});
