<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{
    protected $table='estimation';
    protected $fillable=[
        'origin',
        'destination',
        'distance',
        'distance_value',
        'duration',
        'duration_value'
    ];
}
