<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Berita;

class ProfilUser extends Model
{
    protected $table = 'profil_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'nama', 'jenkel', 'kontak', 'alamat', 'nik', 'foto', 'deskripsi', 'status'
    ];

    public function berita()
    {
        return $this->belongTo('App\Berita', 'author_Id', 'id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function tenantmentor()
    {
        return $this->belongsTo(TenantMentor::class, 'tenant_mentor');
    }
}
