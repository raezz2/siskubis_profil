<?php

namespace App;

use App\Event;
use App\Tenant;
use App\ProfilUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = ['name', 'inkubator_id', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    public function pengumuman()
    {
        return $this->hasMany('App\Pengumuman');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  
    public function surat(){
        // return $this->hasMany('App\Surat');

        return $this->belongsToMany('App\Surat');
    }
    public function tenants()
    {
        return $this->belongsToMany('App\Tenant');
    }
    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }
    public function events()
    {
        return $this->hasMany(Event::class, 'author_id');
    }

    public function TenantUser()
    {
        return $this->belongsToMany(TenantUser::class, 'tenant_user');
    }

    public function ProfilUser()
    {
        return $this->belongsToMany(ProfilUser::class, 'profil_user');
    }
    public function tenantId()
    {
        return $this->tenants()->first()->id;
    }
    public function profile()
    {
        // one user can only have one profile
        return $this->hasOne(ProfilUser::class, 'user_id');
    }
    public function user()
    {
        return $this->belongsTo('App\ProfilUser','id', 'user_id');
    }
}

