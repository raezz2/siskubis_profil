<?php

namespace App;

use App\Priority;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $guarded = ['id'];
    protected $dates = ['tgl_mulai', 'tgl_selesai', 'waktu_mulai', 'waktu_selesai'];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function scopeDateBetween($query, $start, $end)
    {
        return $query->whereBetween('tgl_mulai', [$start, $end]);
    }

}
