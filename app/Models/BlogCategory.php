<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected $fillable = ['TenDanhMuc', 'slug', 'MoTa', 'TrangThai'];
    public $timestamps = true;

    /**
     * Quan hệ với BaiViet
     */
    public function posts()
    {
        return $this->hasMany(BaiViet::class, 'MaDanhMuc', 'id');
    }

    /**
     * Tự động generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->TenDanhMuc, '-');

                $count = static::where('slug', $model->slug)->count();
                if ($count > 0) {
                    $model->slug = $model->slug . '-' . ($count + 1);
                }
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('TenDanhMuc') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->TenDanhMuc, '-');

                $count = static::where('slug', $model->slug)->where('id', '!=', $model->id)->count();
                if ($count > 0) {
                    $model->slug = $model->slug . '-' . ($count + 1);
                }
            }
        });
    }

    /**
     * Scope: Lấy danh mục công khai
     */
    public function scopeActive($query)
    {
        return $query->where('TrangThai', 1);
    }
}
