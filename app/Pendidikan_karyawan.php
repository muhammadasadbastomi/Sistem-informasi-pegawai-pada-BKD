<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan_karyawan extends Model
{
    protected $hidden = [
        'id','karyawan_id','pendidikan_id',
    ];
    
    public function pendidikan()
    {
        return $this->belongsTo('App\Pendidikan');
    }
}
