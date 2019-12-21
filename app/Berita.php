<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'uuid','karyawan_id','judul','foto','isi'
    ];

    protected $hidden = [
        'id'
    ];

    public function User()
    {
        return $this->BelongsTo('App\User');
    }
}
