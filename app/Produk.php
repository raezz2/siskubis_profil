<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded = [];
    public $timestamps = false;

    public function tenant()
    {
    	return $this->belongsTo('App\Tenant','tenant_id','id');
    }

    public function priority()
    {
    	return $this->belongsTo('App\Priority');
    }

    public function produk_bisnis()
    {
        return $this->hasOne('App\ProdukBisnis');
    }

    public function produk_canvas()
    {
        return $this->hasOne('App\ProdukCanvas');
    }

    public function produk_ijin()
    {
        return $this->hasOne('App\ProdukIjin');
    }

    public function produk_image()
    {
    	return $this->belongsTo('App\ProdukImage','id','produk_id');
    }

    public function produk_ki()
    {
        return $this->hasOne('App\ProdukKI');
    }

    public function produk_riset()
    {
        return $this->hasOne('App\ProdukRiset');
    }

    public function produk_sertifikasi()
    {
        return $this->hasOne('App\ProdukSertifikasi');
    }

    public function produk_team()
    {
        return $this->belongsTo('App\ProdukTeam','id','produk_id');
    }
}
