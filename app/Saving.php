<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $table='SavingMatrix';
    protected $fillable=[
        'id',
        'Kode_Origin',
        'Kode_Destination',
        'Saving'
    ];
}
