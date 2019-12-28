<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diklat_karyawan extends Model
{
    protected $hidden = [
        'id','karyawan_id','diklat_id',
    ];

    public function pendidikan()
    {
        return $this->belongsTo('App\Diklat');
    }
}
