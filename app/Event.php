<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    // protected $fillable = [
    //     'title', 'slug', 'foto', 'priority_id', 'event', 'publish',
    // ];

    protected $guarded = ['id'];
}
