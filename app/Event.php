<?php

namespace App;

use App\Priority;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    // protected $fillable = [
    //     'title', 'slug', 'foto', 'priority_id', 'event', 'publish',
    // ];

    protected $guarded = ['id'];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }
}
