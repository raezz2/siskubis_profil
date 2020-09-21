<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priority';
    public function surat()
    {
        return $this->hasMany('App\Surat');
    }
}
