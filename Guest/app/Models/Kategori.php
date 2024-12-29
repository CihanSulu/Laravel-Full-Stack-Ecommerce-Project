<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "tbl_kategori";
    public $timestamps = false;

    public function Urunler(){
        return $this->belongsToMany(Urunler::class,'tbl_urun_kategori','kategori_id','urun_id','id','id')->orderBy('id','desc');
    }
}
