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

    // protected $dates = ['created_at', 'updated_at', 'waktu','waktu_selanjutnya'];

    public function diklat_karyawan()
    {
    	return $this->belongsToMany('App\Diklat_karyawan');
    }
}
