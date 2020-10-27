<?php

namespace App;

use App\Tenant;
use Illuminate\Database\Eloquent\Model;

class TenantMentor extends Model
{
    Protected $table = 'tenant_mentor';

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
        return $this->hasMany(Produk::class);
    }
}
