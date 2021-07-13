<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dijkstra extends Model
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

    public function cabangs()
    {
        return $this->belongsTo(Cabang::class, 'id');
    }
}