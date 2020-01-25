<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat_pangkat extends Model
{
    protected $hidden = [
        'id','karyawan_id','golongan_id',
    ];
    
    public function golongan()
    {
        return $this->belongsTo('App\Golongan');
    }
}
