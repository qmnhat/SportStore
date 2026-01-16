<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{

    protected $table = 'SanPham';
    protected $primaryKey = 'MaSP';
    public $timestamps = false; // Nếu bảng không có các cột created_at và updated_at
}
