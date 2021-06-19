<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matrix extends Model
{
    protected $table='MatrixJarak';
    protected $fillable=[
        'id',
        'Kode_Origin',
        'Kode_Destination',
        'Distance'
    ];
}
