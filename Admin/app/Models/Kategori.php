<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "tbl_kategori";
    
    public function parentCategory()
    {
        return $this->belongsTo(Kategori::class, 'category_sub');
    }
    
    public $timestamps = false;
}
