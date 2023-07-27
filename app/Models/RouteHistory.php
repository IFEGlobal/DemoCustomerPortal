<?php

namespace App\Models;

use App\Scopes\RouteHistoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteHistory extends Model
{
    use HasFactory;

    protected $connection = 'onthefly';

    protected static function booted()
    {
        static::addGlobalScope(new RouteHistoryScope);
    }

    protected $fillable = [
        'shipment_id',
        'loading_port',
        'discharge_port',
        'vessel',
        'voyage',
        'carrier_code',
        'carrier_scac_code',
        'estimated_arrival',
        'estimated_departure',
        'port_arrival_date'
    ];

    protected $dates = [
        'estimated_arrival',
        'estimated_departure',
        'port_arrival_date'
    ];

    // Relationships

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
