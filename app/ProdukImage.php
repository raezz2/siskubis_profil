<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukImage extends Model
{
    protected $table = "produk_image";

   	public function produk()
    {
    	return $this->belongsTo('App\Produk','produk_id', 'id');
    }
}
