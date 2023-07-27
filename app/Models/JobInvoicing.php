<?php

namespace App\Models;

use App\Scopes\ChargeLinesScope;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInvoicing extends Model
{
    use HasFactory, Compoships;

    protected $connection = 'onthefly';

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new ChargeLinesScope);
    }

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

    public function jobCosting(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JobCosting::class, 'job_costing_id', 'id');
    }

    public function linkedDocument()
    {
        return $this->belongsTo(Document::class, ['sell_invoice_number', 'shipment_id'], ['linked_reference', 'shipment_id']);
    }
}
