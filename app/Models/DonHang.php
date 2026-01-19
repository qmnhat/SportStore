<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    // Tên bảng (vì không theo chuẩn Laravel)
    protected $table = 'DonHang';

    // Khóa chính
    protected $primaryKey = 'MaDH';

    // Vì bảng không có created_at, updated_at
    public $timestamps = false;

    // Cho phép gán dữ liệu hàng loạt
    protected $fillable = [
        'MaKH',
        'NgayDat',
        'TrangThai',
        'IsDeleted'
    ];

    // Ép kiểu dữ liệu (an toàn khi xử lý)
    protected $casts = [
        'NgayDat'   => 'datetime',
        'IsDeleted' => 'boolean'
    ];

    // Quan hệ: Đơn hàng thuộc về Khách hàng
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }
}
