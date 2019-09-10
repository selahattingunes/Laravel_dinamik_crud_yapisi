<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinif extends Model
{
    protected $fillable = ["sinif"];

    public function Dersler(){
        return $this->hasMany(Ders::class,'sinif_id');
    }
}
