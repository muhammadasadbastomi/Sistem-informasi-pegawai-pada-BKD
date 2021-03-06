<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'uuid','nama','NIP', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'jk','agama',
        'status_pegawai', 'status_kawin', 'golongan_darah','unit_kerja_id','foto'
    ];
    protected $hidden = [
        'id', 
    ];

    public function unit_kerja()
    {
        return $this->belongsTo('App\Unit_kerja');
    }

    public function golongan()
    {
        return $this->belongsTo('App\Golongan');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan');
    }

    public function pendidikan_karyawan()
    {
    	return $this->belongsToMany('App\Pendidikan_karyawan');
    }

    public function diklat_karyawan()
    {
    	return $this->belongsToMany('App\Diklat_karyawan');
    }

    public function riwayat_pangkat()
    {
    	return $this->belongsToMany('App\Riwayat_pangkat');
    }

    public function riwayat_jabatan()
    {
    	return $this->belongsToMany('App\Riwayat_jabatan');
    }
}
