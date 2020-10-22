<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantMentor extends Model
{
    protected $table = 'tenant_mentor';


    public function user()
    {

        return $this->belongsTo('App\User');
    }
    public function tenants()
    {

        return $this->belongsTo('App\Tenant');
    }
}
