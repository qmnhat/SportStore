<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaiVietComment extends Model
{
    use SoftDeletes;

    protected $table = 'bai_viet_comments';
    protected $fillable = [
        'MaBV',
        'NguoiDung',
        'NoiDung',
        'XepHang',
        'TrangThai',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Quan hệ với BaiViet
     */
    public function post()
    {
        return $this->belongsTo(BaiViet::class, 'MaBV', 'MaBV');
    }

    /**
     * Quan hệ với User (người comment)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'NguoiDung', 'id');
    }

    /**
     * Scope: Lấy comment đã duyệt
     */
    public function scopeApproved($query)
    {
        return $query->where('TrangThai', 1);
    }

    /**
     * Scope: Sắp xếp từ mới nhất
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
