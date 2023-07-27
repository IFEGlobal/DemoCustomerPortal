<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_name',
        'service_url',
        'service_token',
        'service_username',
        'service_password',
        'token_type',
        'access_check_result',
        'test_date',
    ];

    protected $dates = [
        'test_date'
    ];

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Events::class, 'event_registration_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function latestEventResponseAttr()
    {
        if($this->events()->exists())
        {
            return $this->events()->latest()->pluck('response_status') ?? 404;
        }

        return 200;
    }
}
