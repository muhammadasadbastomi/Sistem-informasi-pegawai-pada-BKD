<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan_karyawan extends Model
{
    
    public function pendidikan()
    {
        return $this->belongsTo('App\Pendidikan');
    }
}
