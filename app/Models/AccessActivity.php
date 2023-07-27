<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_login_uuid',
        'ip_address',
        'location_city',
        'location_region',
        'location_country',
        'location_post_zip_code',
        'location_latitude',
        'location_longitude',
        'location_timezone',
        'log_in',
        'log_out',
    ];

    protected $dates = [
        'log_in',
        'log_out'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
