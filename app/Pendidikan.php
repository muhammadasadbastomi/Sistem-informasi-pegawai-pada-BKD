<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $fillable = [
        'uuid','kode_pendidikan','nama','tahun_lulus'
    ];

    protected $hidden = [
        'id'
    ];

    public function pendidikan_karyawan()
    {
    	return $this->belongsToMany('App\Pendidikan_karyawan');
    }
}
