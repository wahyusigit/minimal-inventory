<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MutasiBarang extends Model
{
    public function barang(){
    	return $this->hasOne(Barang::class,'id','id_barang');
    }
}
