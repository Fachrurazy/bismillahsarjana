<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $table='rute';
    protected $fillable=[
        'id',
        'kelompok'
    ];

    public function cabangs()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }
    public function cabangsaving()
    {
        return $this->belongsTo(Cabang::class, 'id');
    }
    public function rute_detail()
    {
        return $this->belongsTo(Rute_Detail::class);
    }
    public function getdetail()
    {
        return $this->hasMany(rute_detail::class, 'id_rute');
    }
}
