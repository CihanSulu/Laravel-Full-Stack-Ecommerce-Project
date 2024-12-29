<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kullanici extends Model
{
    protected $table = "tbl_user";
    public $timestamps = false;
    use HasFactory;
}
