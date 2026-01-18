<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    //
    protected $table = 'BaiViet';
    protected $primaryKey = 'MaBV';
    public $timestamps = false;
    protected $fillable = [
        'TieuDe',
        'slug',
        'NoiDung',
        'HinhAnh',
        'TomTat',
        'NguoiTao',
        'NgayTao',
        'NgayCapNhat',
        'TrangThai',
        'IsDeleted',
        'DeletedAt',
    ];

    protected $casts = [
        'IsDeleted' => 'boolean',
        'DeletedAt' => 'datetime',
        'NgayTao' => 'datetime',
        'NgayCapNhat' => 'datetime',
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'NguoiTao', 'id');
    }
}
