<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BienTheSanPham extends Model
{
    protected $table = 'bienthesanpham';
    protected $primaryKey = 'MaBT';
    public $timestamps = false;

    protected $fillable = [
        'MaSP',
        'MaKT',
        'GiaGoc',
        'SoLuong',
        'TrangThai',
        'IsDeleted',
        'DeletedAt',
    ];

    protected $casts = [
        'GiaGoc' => 'decimal:2',
        'IsDeleted' => 'boolean',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }

    public function kichThuoc()
    {
        return $this->belongsTo(KichThuoc::class, 'MaKT', 'MaKT');
    }
}
