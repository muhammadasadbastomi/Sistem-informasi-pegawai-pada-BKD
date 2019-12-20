<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'uuid','NIP', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon'
    ];
    protected $hidden = [
        'id', 'user_id'
    ];

    public function user(){
      return $this->BelongsTo('App\User');
    }

    public function berita()
    {
        return $this->HasMany('App\Berita');
    }
}
