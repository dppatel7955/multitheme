<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant
{
    use HasDomains;

    /**
     * Get or set the tenant's primary UI color.
     */
    public function getPrimaryColorAttribute()
    {
        return $this->data['primary_color'] ?? '#2563eb'; // default blue
    }
}
