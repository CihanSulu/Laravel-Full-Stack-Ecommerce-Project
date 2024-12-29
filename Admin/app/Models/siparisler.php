<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siparisler extends Model
{
    protected $table = "tbl_siparis";
    public $timestamps = false;

    public function kategorisi(){
        return $this->hasMany(siparisKategori::class,'id','kategori');
    }
    public function Urunler(){
        return $this->belongsToMany(Urunler::class,'tbl_siparis_urun','siparis_id','urun_id','id','id');
    }

}
