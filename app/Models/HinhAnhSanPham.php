<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HinhAnhSanPham extends Model
{
    protected $table = 'hinhanhsanpham';
    protected $primaryKey = 'MaHinh';
    public $timestamps = false;

    protected $fillable = [
        'MaSP',
        'DuongDan',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }
}
