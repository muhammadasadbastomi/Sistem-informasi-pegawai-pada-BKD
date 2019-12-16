<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $fillable = [
        'uuid','kelurahan_id','kode_instansi','nama','alamat'
    ];

    protected $hidden = [
        'id','kelurahan_id'
    ];

    public function kelurahan()
    {
        return $this->BelongsTo('App\Kelurahan');
    }
}
