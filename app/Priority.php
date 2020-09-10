<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priority';

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
