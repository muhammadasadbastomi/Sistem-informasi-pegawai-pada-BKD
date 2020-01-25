<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat_jabatan extends Model
{
    protected $hidden = [
        'id','karyawan_id','jabatan_id',
    ];
    
    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan');
    }
}
