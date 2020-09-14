<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = ['id', 'title', 'dari', 'prihal', 'kepada','dokumen', 'jenis_surat', 'author_id'];


    public function users(){
        
        return $this->belongsTo('App\Users');
        // return $this->hasMany('App\User');
    }

    
}

