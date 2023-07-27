<?php

namespace App\Models;

use App\Scopes\ContainerScope;
use App\Traits\RecordOwnershipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory, RecordOwnershipTrait;

    protected $connection = 'onthefly';

    protected static function booted()
    {
        static::addGlobalScope(new ContainerScope);
    }

    protected $fillable = [
        'shipment_id',
        'container_no',
        'container_mode',
        'container_type',
        'fcl_on_board_vessel',
        'container_delivery',
        'milestones',
    ];

    protected $dates = [
        'container_delivery',
    ];

    protected $casts = [
        'milestones' => 'array',
        'route_history' => 'array',
        'polyline' => 'array',
    ];

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function containerDelivery(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ContainerDelivery::class);
    }

    public function getShipmentStatusAttribute(): ?string
    {
        if($this->shipment->estimated_arrival > now()->subdays(7))
        {
            return 'Active';
        }

        return 'Archived';
    }

    public function favorates(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    public function priorities(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }
}
