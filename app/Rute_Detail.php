<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rute_Detail extends Model
{
    protected $table='rute_detail';
    protected $fillable=[
        'id',
        'id_cabang',
        'created_at',
        'updated_at',
        'id_rute'
    ];
    public function cabangs()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }
    public function rutes()
    {
        return $this->belongsTo(Rute::class);
    }
}
