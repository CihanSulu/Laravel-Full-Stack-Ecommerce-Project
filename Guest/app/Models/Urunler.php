<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urunler extends Model
{
    protected $table = "tbl_urunler";
    public $timestamps = false;

    public function Resimler(){
        return $this->hasMany(urunResim::class,'urun_id','id')->orderBy('id','desc');
    }
    public function Kategoriler(){
        return $this->belongsToMany(Kategori::class,'tbl_urun_kategori','urun_id','kategori_id','id','id')->orderBy('id','desc');
    }

}
