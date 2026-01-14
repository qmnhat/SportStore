<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    protected $table = 'ThuongHieu';
    protected $primaryKey = 'MaTH';
    public $timestamps = false;

    protected $fillable = [
        'TenTH',
        'MoTa',
        'IsDeleted',
        'DeletedAt',
    ];

    protected $casts = [
        'IsDeleted' => 'boolean',
        'DeletedAt' => 'datetime',
    ];
}
