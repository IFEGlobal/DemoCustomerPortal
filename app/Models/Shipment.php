<?php

namespace App\Models;

use App\Scopes\ShipmentScope;
use App\Traits\RecordOwnershipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Shipment extends Model
{
    use HasFactory, RecordOwnershipTrait, Searchable;

    protected $connection = 'onthefly';

    protected static function booted()
    {
        static::addGlobalScope(new ShipmentScope);
    }

    protected $guarded = [];

    protected $dates = [
        'estimated_departure',
        'estimated_arrival',
        'actual_arrival',
        'estimated_delivery',
        'actual_delivery',
        'cartage_advise_issued',
        'port_arrival_date',
        'cleared_date',
    ];

    protected $casts =[
      'co2_estimated_data' => 'array',
      'co2_actual_data' => 'array'
    ];

    public function recordOwnership(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ownership::class);
    }

    public function containers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Container::class);
    }

    public function transportBookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TransportBooking::class);
    }

    public function containerDeliveries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ContainerDelivery::class, 'shipment_id', 'id');
    }

    public function documents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(JobCosting::class);
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobInvoicing::class, 'shipment_id', 'id');
    }

    public function timeCritical(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TimeCritical::class, 'shipment_id', 'id');
    }

    public function transitTimeAttribute(): int
    {
        if(is_null($this->estimated_departure))
        {
            return 0;
        }

        if(is_null($this->estimated_arrival))
        {
            return 0;
        }

        return $this->estimated_departure->diffInDays($this->estimated_arrival);
    }

    public function shipmentDataStatusAttribute(): string
    {
        if((!is_null($this->estimated_arrival)) && (is_null($this->port_arrival_date)))
        {
            if($this->estimated_arrival > now()->subDays(30))
            {
                return 'Active';
            }

            if($this->estimated_arrival < now()->subDays(30))
            {
                return 'Archived';
            }
        }

        if(!is_null($this->port_arrival_date))
        {
            if($this->port_arrival_date > now()->subDays(30))
            {
                return 'Active';
            }

            if($this->port_arrival_date < now()->subDays(30))
            {
                return 'Archived';
            }
        }

        return 'Active';
    }

    public function getDirectionAttribute(): string
    {
        if((Str::contains($this->loading_port_code, "GB")) && (!Str::contains($this->disc_port_code, "GB")) )
        {
            return 'Export';
        }

        if((!Str::contains($this->loading_port_code, "GB")) && (Str::contains($this->disc_port_code, "GB")) )
        {
            return 'Import';
        }

        return 'Cross Trade';
    }

    public function directionsWidgetAttribute(): string
    {
        if($this->loading_port_code == null)
        {
            return 'Awaiting Port Data';
        }

        if($this->disc_port_code == null)
        {
            return 'Awaiting Port Data';
        }

        return $this->loading_port_name.' to '.$this->disc_port_name;
    }

    public function trackingSliderAttribute(): float|int
    {
        if($this->estimated_arrival < now())
        {
            return 100;
        }

        if(is_null($this->estimated_arrival))
        {
            return 0;
        }

        if(is_null($this->estimated_departure))
        {
            return 0;
        }

        if($this->estimated_departure > now())
        {
            return 0;
        }

        if(($this->estimated_departure < now()) && ($this->estimated_arrival > now()))
        {
            $percentage = 0;
            $totalDays = $this->estimated_departure->diffInDays($this->estimated_arrival);

            $remainingDays = now()->diffInDays($this->estimated_arrival);

            $daysDifference = $totalDays - $remainingDays;

            if($totalDays != 0)
            $percentage = ($daysDifference/$totalDays)*100;

            return $percentage;
        }

        return 100;
    }

    public function getRemainingDaysAttribute(): int|string
    {
        if($this->estimated_arrival < now())
        {
            return 0;
        }

        if(is_null($this->estimated_arrival))
        {
            return 'No Dates Available';
        }

        if(is_null($this->estimated_departure == null))
        {
            return 'No Dates Available';
        }

        if($this->estimated_departure > now())
        {
            return 'Awaiting Departure';
        }

        if(($this->estimated_departure < now()) && ($this->estimated_arrival > now()))
        {
            return now()->diffInDays($this->estimated_arrival);
        }

        return 100;
    }

    public function GetAverageVoyageIndicatorAttribute()
    {
        if($this->transit_days !== null && $this->route_avg !== null)
        {
            return ($this->transit_days - $this->route_avg);
        }

        return null;
    }
}
