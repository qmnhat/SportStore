<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    //nghia_start
    protected $table = 'SanPham';
    protected $primaryKey = 'MaSP';
    public $timestamps = false; // Nếu bảng không có các cột created_at và updated_at

    protected $fillable = [
        'TenSP',
        'MaDM',
        'MaTH',
        'MoTa',
        'TrangThai',
        'IsDeleted',
        'DeletedAt',
    ];
    protected $casts = [
        'IsDeleted' => 'boolean',
        'DeletedAt' => 'datetime',
    ];
    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'MaDM', 'MaDM');
    }
    public function thuongHieu(){
        return $this->belongsTo(ThuongHieu::class,'MaTH','MaTH');
    }
    //nghia_end


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
