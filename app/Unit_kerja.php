<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit_kerja extends Model
{
    protected $fillable = [
        'uuid','instansi_id','kode_unit','nama','alamat'
    ];

    protected $hidden = [
        'id','instansi_id'
    ];
}
