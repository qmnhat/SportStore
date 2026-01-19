<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KichThuoc extends Model
{
    protected $table = 'KichThuoc';
    protected $primaryKey = 'MaKT';
    public $timestamps = false;
    protected $fillable = [
        'TenKT',
    ];

    public function bienThes()
    {
        return $this->hasMany(BienTheSanPham::class, 'MaKT', 'MaKT');
    }
}
