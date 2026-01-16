<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BienTheSanPham extends Model
{
    protected $table = 'bienthesanpham';
    protected $primaryKey = 'MaBT';
    public $timestamps = false;
}
