<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'ChiTietDonHang';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'MaDH',
        'MaBT',
        'SoLuong',
    ];

    // Quan hệ với DonHang
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'MaDH', 'MaDH');
    }

    // Quan hệ với BienTheSanPham
    public function bienThe()
    {
        return $this->belongsTo(BienTheSanPham::class, 'MaBT', 'MaBT');
    }
}
