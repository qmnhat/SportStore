<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    //
    protected $table='DanhMuc';
    protected $primaryKey='maDM';
    public $timestamps=false;
    protected $fillable=[
        'TenDM',
        'MoTa',
        'IsDeleted',
        'DeletedAt'

    ];
    protected $casts = [
        'IsDeleted' => 'boolean',
        'DeletedAt' => 'datetime',
    ];
    public function sanPhams(){
        return $this->hasMany(SanPham::class,'MaDM','MaDM');
    }
}
