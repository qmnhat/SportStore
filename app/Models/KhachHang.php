<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class KhachHang extends Model
{
    protected $table = 'KhachHang';
    protected $primaryKey = 'MaKH';
    public $timestamps = false;

    protected $fillable = [
        'HoTen',
        'Email',
        'MatKhau',
        'DiaChi',
        'SDT',
        'NgaySinh',
        'GioiTinh',
        'TrangThai',
        'NgayTao',
        'IsDeleted',
        'DeletedAt'
    ];

    protected $casts = [
        'NgaySinh' => 'date',
        'NgayTao' => 'datetime',
        'IsDeleted' => 'boolean',
        'TrangThai' => 'boolean',
    ];
}
