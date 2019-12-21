<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'uuid','NIP', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'jk','agama',
        'status_pegawai', 'status_kawin', 'golongan_darah','unit_kerja_id'
    ];
    protected $hidden = [
        'id', 'unit_kerja_id'
    ];

    public function unit_kerja()
    {
    return $this->belongsTo('App\Unit_kerja');
    }
}
