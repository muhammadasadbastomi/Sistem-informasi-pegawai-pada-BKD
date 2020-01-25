<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $fillable = [
        'uuid','kode_golongan', 'golongan'
    ];

    protected $hidden = [
        'id'
    ];

    public function karyawan()
    {
        return $this->HasMany('App\Karyawan');
    }

    public function riwayat_pangkat()
    {
    	return $this->belongsToMany('App\Riwayat_pangkat');
    }
}
