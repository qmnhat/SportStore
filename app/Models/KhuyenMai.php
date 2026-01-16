<?php

namespace App\Http\Controllers\Admin;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    protected $table = 'KhuyenMai';

    protected $primaryKey = 'MaKM';

    // Vì khóa chính là increments int
    public $incrementing = true;

    protected $keyType = 'int';


    public $timestamps = false;

    protected $fillable = [
        'TenKM',
        'PhanTramGiam',
        'NgayBatDau',
        'NgayKetThuc',
        'TrangThai',
        'IsDeleted',
        'DeletedAt'
    ];

    protected $casts = [
        'PhanTramGiam' => 'integer',
        'TrangThai'   => 'integer',
        'IsDeleted'   => 'boolean',
        'NgayBatDau'  => 'date',
        'NgayKetThuc' => 'date',
        'DeletedAt'   => 'datetime'
    ];

    public function scopeActive($query)
    {
        return $query->where('IsDeleted', false);
    }

    public function scopeValid($query)
    {
        $today = now()->toDateString();

        return $query->where('TrangThai', 1)
            ->where('IsDeleted', false)
            ->whereDate('NgayBatDau', '<=', $today)
            ->whereDate('NgayKetThuc', '>=', $today);
    }
}
