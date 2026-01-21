<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SanPham extends Model
{
    //nghia_start
    protected $table = 'SanPham';
    protected $primaryKey = 'MaSP';
    public $timestamps = false; // Nếu bảng không có các cột created_at và updated_at

    protected $fillable = [
        'TenSP',
        'slug',
        'MaDM',
        'MaTH',
        'MoTa',
        'TrangThai',
        'NoiBat',
        'IsDeleted',
        'DeletedAt',
    ];

    /**
     * Auto-generate slug từ TenSP khi creating
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->TenSP);
                // Đảm bảo slug unique
                $counter = 1;
                $originalSlug = $model->slug;
                while (static::where('slug', $model->slug)->exists()) {
                    $model->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('TenSP') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->TenSP);
                // Đảm bảo slug unique
                $counter = 1;
                $originalSlug = $model->slug;
                while (static::where('slug', $model->slug)->where('MaSP', '!=', $model->MaSP)->exists()) {
                    $model->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }
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
