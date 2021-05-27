<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table='cabang';
    protected $fillable=[
        'id',
        'Nama_Cabang',
        'Pemilik',
        'Telepon',
        'Alamat',
        'Latitude',
        'Longitude'
    ];
}
