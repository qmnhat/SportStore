<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaiViet extends Model
{
    use SoftDeletes;

    protected $table = 'BaiViet';
    protected $primaryKey = 'MaBV';
    public $timestamps = true;
    const CREATED_AT = 'NgayTao';
    const UPDATED_AT = 'NgayCapNhat';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        'TieuDe',
        'slug',
        'NoiDung',
        'HinhAnh',
        'TomTat',
        'MaDanhMuc',
        'NguoiTao',
        'LuotXem',
        'TrangThai',
    ];

    protected $casts = [
        'NgayTao' => 'datetime',
        'NgayCapNhat' => 'datetime',
        'DeletedAt' => 'datetime',
    ];

    /**
     * Quan hệ với User (tác giả)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'NguoiTao', 'id');
    }

    /**
     * Quan hệ với BlogCategory
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'MaDanhMuc', 'id');
    }

    /**
     * Quan hệ với Comment
     */
    public function comments()
    {
        return $this->hasMany(BaiVietComment::class, 'MaBV', 'MaBV');
    }

    /**
     * Tự động generate slug từ tiêu đề
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->TieuDe, '-');

                // Nếu slug đã tồn tại, thêm số vào cuối
                $count = static::where('slug', $model->slug)->count();
                if ($count > 0) {
                    $model->slug = $model->slug . '-' . ($count + 1);
                }
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('TieuDe') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->TieuDe, '-');

                // Nếu slug đã tồn tại (và khác bài viết hiện tại), thêm số vào cuối
                $count = static::where('slug', $model->slug)->where('MaBV', '!=', $model->MaBV)->count();
                if ($count > 0) {
                    $model->slug = $model->slug . '-' . ($count + 1);
                }
            }
        });
    }

    /**
     * Tăng lượt xem
     */
    public function incrementView()
    {
        $this->increment('LuotXem');
    }

    /**
     * Scope: Lấy bài viết công khai
     */
    public function scopeActive($query)
    {
        return $query->where('TrangThai', 1);
    }

    /**
     * Scope: Sắp xếp theo thứ tự mới nhất
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('NgayTao', 'desc');
    }

    /**
     * Scope: Tìm kiếm
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('TieuDe', 'like', "%{$keyword}%")
                    ->orWhere('TomTat', 'like', "%{$keyword}%")
                    ->orWhere('NoiDung', 'like', "%{$keyword}%");
    }
}
