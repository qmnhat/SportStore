<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YeuThich extends Model
{
    protected $table = 'YeuThich';

    protected $fillable = [
        'MaKH',
        'MaSP'
    ];
}
