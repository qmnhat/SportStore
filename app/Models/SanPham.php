<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{

    protected $table = 'SanPham';
    protected $primaryKey = 'MaSP';
    public $timestamps = false; // Nếu bảng không có các cột created_at và updated_at

    public function hinhAnh()
    {
        return $this->hasMany(HinhAnhSanPham::class, 'MaSP', 'MaSP');
    }
    public function bienThe()
    {
        return $this->hasMany(BienTheSanPham::class, 'MaSP', 'MaSP');
    }
    public function khuyenMai()
    {
        return $this->belongsToMany(
            KhuyenMai::class,
            'sanphamkhuyenmai',
            'MaSP',
            'MaKM'
        );
    }

}
