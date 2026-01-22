<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    //
    protected $table = 'PhieuNhap';
    protected $primaryKey = 'MaPN';
    public $timestamps = false;

    protected $fillable = [
        'MaQL',
        'MaNCC',
        'NgayNhap',
        'GhiChu',
        'TrangThai',
        'IsDeleted',
        'DeletedAt',
    ];

    protected $casts = [
        'NgayNhap' => 'datetime',
        'IsDeleted' => 'boolean',
    ];

    // Quan hệ với NhaCungCap
    public function nhaCungCap()
    {
        return $this->belongsTo(NhaCungCap::class, 'MaNCC', 'MaNCC');
    }

    // Quan hệ với NhaQuanLy
    public function nhaQuanLy()
    {
        return $this->belongsTo(NhaQuanLy::class, 'MaQL', 'MaQL');
    }

    // Quan hệ với ChiTietPhieuNhap
    public function chiTiet()
    {
        return $this->hasMany(ChiTietPhieuNhap::class, 'MaPN', 'MaPN');
    }

    // Tính tổng tiền nhập
    public function getTongTienAttribute()
    {
        return $this->chiTiet->sum(function ($ct) {
            return $ct->SoLuong * $ct->GiaNhap;
        });
    }
}
