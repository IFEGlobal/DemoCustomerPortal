<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_registration_id',
        'event_type',
        'event',
        'event_sent',
        'response_status',
        'response_string',
    ];

    protected $dates = [
        'event-sent'
    ];

    protected $casts = [
      'event' => 'array'
    ];

    public function outbound_service(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(EventRegistration::class, 'event_registration_id', 'id');
    }
}
