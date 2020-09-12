<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';


    public function user(){
    	return $this->belongsTo('App\User');
    }

    
}

