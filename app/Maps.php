<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maps extends Model
{
    protected $table='koordinat';
    protected $fillable=['nama_koordinat','lat','long'];
}

