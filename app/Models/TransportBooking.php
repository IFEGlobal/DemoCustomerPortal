<?php

namespace App\Models;

use App\Scopes\TransportBookingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportBooking extends Model
{
    use HasFactory;

    protected $connection = 'onthefly';

    protected static function booted()
    {
        static::addGlobalScope(new TransportBookingScope);
    }

    protected $guarded = [];

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function containerDeliveries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ContainerDelivery::class, 'transport_booking_id', 'id');
    }
}
