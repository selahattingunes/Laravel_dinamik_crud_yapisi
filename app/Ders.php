<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ders extends Model
{
    protected $fillable = ["sinif_id","ders"];

    public function Sinif(){
        return $this->belongsTo(Sinif::class,'sinif_id');
    }

}
