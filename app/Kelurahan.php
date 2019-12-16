<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $fillable = [
        'uuid','kecamatan_id','kode_kelurahan','kelurahan'
    ];

    protected $hidden = [
        'id','kecamatan_id'
    ];
}
