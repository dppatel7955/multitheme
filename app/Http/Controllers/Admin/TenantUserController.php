<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class TenantUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tenantId)
    {
        $tenant = Tenant::findOrFail($tenantId);
        
        // We run explicitly in the context of the tenant to easily fetch its users automatically scoped
        $users = $tenant->run(function () {
            return User::all();
        });

        return view('admin.tenants.users.index', compact('tenant', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $tenantId)
    {
        $tenant = Tenant::findOrFail($tenantId);
        return view('admin.tenants.users.create', compact('tenant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $tenantId)
    {
        $tenant = Tenant::findOrFail($tenantId);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Ensures the email is globally unique across the whole users table
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Run the creation context directly inside the tenant!
        // This natively respects BelongsToTenant scope and injects `tenant_id` automatically!
        $tenant->run(function () use ($validated) {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        });

        return redirect()->route('admin.tenants.users.index', $tenant->id)
                         ->with('success', 'User successfully added to tenant.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tenantId, string $userId)
    {
        $tenant = Tenant::findOrFail($tenantId);
        
        $tenant->run(function () use ($userId) {
            $user = User::findOrFail($userId);
            $user->delete();
        });

        return redirect()->route('admin.tenants.users.index', $tenant->id)
                         ->with('success', 'User deleted successfully.');
    }
}
