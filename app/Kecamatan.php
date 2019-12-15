<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = [
        'uuid','kode_kecamatan','kecamatan'
    ];

    protected $hidden = [
        'id'
    ];
}
