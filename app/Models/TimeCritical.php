<?php

namespace App\Models;

use App\Scopes\TimeCriticalScope;
use App\Traits\RecordOwnershipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TimeCritical extends Model
{
    use HasFactory, RecordOwnershipTrait, Searchable;

    protected $connection = 'onthefly';

    protected static function booted()
    {
        static::addGlobalScope(new TimeCriticalScope);
    }

    protected $guarded = [];

    protected $dates = [
        'eta',
        'delivered_date',
        'd3_date',
        'estimated_completion_date',
        'completed_date',
        'sail_date',
    ];

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

    public function getKPIAttribute(): string
    {
        if($this->completed_date !== null && $this->estimated_completion_date > $this->completed_date) {
            return 'Excellent';
        }

        if($this->completed_date !== null && $this->estimated_completion_date == $this->completed_date) {
            return 'Satisfied';
        }

        if($this->completed_date !== null && $this->estimated_completion_date < $this->completed_date) {
            return 'Not Met';
        }

        return 'Awaiting Completion';
    }
}
