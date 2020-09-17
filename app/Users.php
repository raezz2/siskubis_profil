<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    protected $fillable = ['name', 'inkubator_id', 'email', 'email_verified_at', '	password', 'remember_token', 'created_at', 'updated_at'];

    public function pengumuman()
    {
        return $this->hasMany('App\Pengumuman');
    }
}
