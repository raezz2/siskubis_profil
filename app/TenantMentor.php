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
}



