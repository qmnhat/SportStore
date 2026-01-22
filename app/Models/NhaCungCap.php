<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    //
    protected $table = 'NhaCungCap';
    protected $primaryKey = 'MaNCC';
    public $timestamps = false;

    protected $fillable = [
        'TenNCC',
        'DiaChi',
        'SDT',
        'Email',
        'TrangThai',
        'IsDeleted',
        'DeletedAt',
        'NgayTao',
    ];

    protected $casts = [
        'NgayTao' => 'datetime',
        'DeletedAt' => 'datetime',
        'IsDeleted' => 'boolean',
    ];

    // Quan hệ với PhieuNhap
    public function phieuNhaps()
    {
        return $this->hasMany(PhieuNhap::class, 'MaNCC', 'MaNCC');
    }
}
