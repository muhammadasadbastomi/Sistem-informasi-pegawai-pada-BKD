<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'uuid','karyawan_id','judul','foto','isi'
    ];

    protected $hidden = [
        'id','karyawan_id'
    ];

    public function karyawan()
    {
        return $this->BelongsTo('App\Karyawan');
    }
}
