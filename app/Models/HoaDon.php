<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoadon';
    protected $primaryKey = 'MaHD';
    public $timestamps = false;

    protected $casts = [
        'TongTien' => 'float',
        'IsDeleted' => 'boolean',
        'NgayLap' => 'datetime',
    ];
}