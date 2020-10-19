<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukImage extends Model
{
    protected $table = "produk_image";

   	public function produk_image()
    {
    	return $this->belongsTo('App\ProdukImage','produk_id', 'id');
    }
}
