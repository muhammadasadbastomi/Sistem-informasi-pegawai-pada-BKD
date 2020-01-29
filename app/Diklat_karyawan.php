<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diklat_karyawan extends Model
{
    protected $hidden = [
        'id','karyawan_id','diklat_id',
    ];

    public function diklat()
    {
        return $this->belongsTo('App\Diklat');
    }

    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan');
    }
}
