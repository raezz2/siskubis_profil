<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantMentor extends Model
{
    protected $table = 'tenant_mentor';

    public function profiluser()
    {
        return $this->belongsTo( 'App\ProfilUser', 'profil_user');
    }
  
    protected $guarded = ['id'];


    public function user()
    {

        return $this->belongsTo('App\User');
    }
    public function tenants()
    {

        return $this->belongsTo('App\Tenant');
    }
}

