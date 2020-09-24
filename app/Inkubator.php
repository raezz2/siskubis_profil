<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Inkubator extends Model
{
    protected $table = 'inkubator';

    public function events()
    {
        return $this->hasMany(Event::class, 'inkubator_id');
    }
}
