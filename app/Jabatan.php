<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'uuid','kode_jabatan', 'jabatan'
    ];

    protected $hidden = [
        'id'
    ];

    public function karyawan()
    {
        return $this->HasMany('App\Karyawan');
    }

    public function riwayat_jabatan()
    {
    	return $this->belongsToMany('App\Riwayat_jabatan');
    }
}
