<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuNhap extends Model
{
    //
     protected $table = 'ChiTietPhieuNhap';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'MaPN',
        'MaBT',
        'SoLuong',
        'GiaNhap',
    ];

    protected $casts = [
        'GiaNhap' => 'decimal:2',
    ];

    // Quan hệ với PhieuNhap
    public function phieuNhap()
    {
        return $this->belongsTo(PhieuNhap::class, 'MaPN', 'MaPN');
    }

    // Quan hệ với BienTheSanPham
    public function bienThe()
    {
        return $this->belongsTo(BienTheSanPham::class, 'MaBT', 'MaBT');
    }

}
