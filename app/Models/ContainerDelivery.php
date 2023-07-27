<?php

namespace App\Models;

use App\Scopes\ContainerDeliveryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerDelivery extends Model
{
    use HasFactory;

    protected $connection = 'onthefly';

    protected static function booted()
    {
        static::addGlobalScope(new ContainerDeliveryScope);
    }

    protected $guarded = [ ];

    protected $dates = [
        'arrival_cartage_advised',
        'arrival_estimated_delivery',
    ];

    public function transportBooking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TransportBooking::class, 'transport_booking_id', 'id');
    }

    public function container(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Container::class);
    }

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function getCountDownAttribute(): ?string
    {
        if($this->arrival_estimated_delivery !== null)
        {
            if($this->arrival_estimated_delivery > now())
            {
                return $this->arrival_estimated_delivery->diffForHumans(['parts' => 2]);
            }

            return 'Delivered';
        }

        return 'Awaiting Delivery Date';
    }
}
