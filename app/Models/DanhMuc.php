<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DanhMuc extends Model
{
    //
    protected $table='DanhMuc';
    protected $primaryKey='MaDM';
    public $timestamps=false;
    protected $fillable=[
        'TenDM',
        'slug',
        'MoTa',
        'IsDeleted',
        'DeletedAt'

    ];

    /**
     * Auto-generate slug từ TenDM khi creating
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->TenDM);
                // Đảm bảo slug unique
                $counter = 1;
                $originalSlug = $model->slug;
                while (static::where('slug', $model->slug)->exists()) {
                    $model->slug = $originalSlug . '-' . $counter++;
                }
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('TenDM') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->TenDM);
                // Đảm bảo slug unique
                $counter = 1;
                $originalSlug = $model->slug;
                while (static::where('slug', $model->slug)->where('MaDM', '!=', $model->MaDM)->exists()) {
                    $model->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }
    protected $casts = [
        'IsDeleted' => 'boolean',
        'DeletedAt' => 'datetime',
    ];
    public function sanPhams(){
        return $this->hasMany(SanPham::class,'MaDM','MaDM');
    }
}
