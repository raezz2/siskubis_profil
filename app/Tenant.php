<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenant';
    protected $fillable = [
        'inkubator_id', 'title', 'subtitle', 'description', 'priority', 'foto', 'bidang_usaha', 'tanggal_berdiri', 'visi', 'misi', 'slogan', 'alamat', 'kontak', 'jam_operasional', 'status', 'updated_at', 'created_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
