<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    //
    protected $fillable=[
        'name',
        'description',
        'address',
        'hotline',
        'email',
        'tax_code',
        'opening_hours',
        'version',
        'mission',
        'employee_count',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'zalo_phone'
    ];
}
