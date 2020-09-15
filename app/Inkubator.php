<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inkubator extends Model
{
    protected $table = 'inkubator';

    public function disposisi()
    {
        return $this->belongsTo('App\Disposisi');
    }
}
