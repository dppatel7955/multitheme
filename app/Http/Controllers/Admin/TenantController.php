<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:tenants,id',
            'domain' => 'required|string|unique:domains,domain',
            'name' => 'nullable|string'
        ]);

        $tenant = Tenant::create([
            'id' => $validated['id'],
            'data' => ['name' => $validated['name'] ?? $validated['id']]
        ]);

        $tenant->domains()->create([
            'domain' => $validated['domain']
        ]);

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used, fallback to edit
        return redirect()->route('admin.tenants.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenant = Tenant::with('domains')->findOrFail($id);
        return view('admin.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tenant = Tenant::findOrFail($id);

        $validated = $request->validate([
            'domain' => 'required|string|unique:domains,domain,' . $tenant->domains->first()?->id,
            'name' => 'nullable|string'
        ]);

        $tenant->update([
            'data' => ['name' => $validated['name'] ?? $tenant->id]
        ]);

        if ($domain = $tenant->domains->first()) {
            $domain->update(['domain' => $validated['domain']]);
        } else {
            $tenant->domains()->create(['domain' => $validated['domain']]);
        }

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant deleted successfully!');
    }
}
