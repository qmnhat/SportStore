<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class NhaQuanLy extends Authenticatable
{
    protected $table = 'NhaQuanLy';
    protected $primaryKey = 'MaQL';
    public $timestamps = false;

    protected $fillable = [
        'HoTen',
        'Email',
        'MatKhau',
        'DiaChi',
        'SDT',
        'NgaySinh',
        'VaiTro',
        'TrangThai',
        'NgayTao',
    ];

    public function getAuthPassword()
    {
        return $this->MatKhau;
    }
}
