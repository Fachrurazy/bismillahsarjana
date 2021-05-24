<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distanion extends Model
{
    protected $table='distanion';
    protected $fillable=[
        'Tujuan',
        'Distance',
        'Duration',
        'Value'
    ];
}
