<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vertex extends Model
{
    protected $table='Vertex';
    protected $fillable=[
        'origin',
        'destination',
        'distanceval',
    ];
}
