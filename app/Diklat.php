<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    protected $fillable = [
        'uuid','kode_diklat', 'nama', 'tempat', 'penyelenggara', 'waktu'
    ];

    protected $hidden = [
        'id'
    ];
}
