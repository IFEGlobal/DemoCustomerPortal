<?php

namespace App\Models;

use App\Scopes\DocumentScope;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Document extends Model
{
    use HasFactory, Compoships;

    protected $connection = 'onthefly';

    protected static function booted()
    {
        static::addGlobalScope(new DocumentScope);
    }

    protected $fillable = [
        'shipment_id',
        'document_type',
        'document_id',
        'document_description',
        'is_published',
        'file_name',
        'saved_date',
        'saved_by',
    ];

    protected $dates = [
        'saved_date',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function chargeLines(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobInvoicing::class, ['shipment_id', 'sell_invoice_number'], ['shipment_id', 'linked_reference'])->orderBy('sell_outstanding_amount', 'desc');
    }

    public function latestCharge(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(JobInvoicing::class, ['sell_invoice_number', 'shipment_id'], ['linked_reference', 'shipment_id']);
    }

    public function outstandingBalanceAttribute()
    {
        $balance = $this->chargeLines->whereNull('sell_fully_paid_date')
            ->map(function($query){;
                return $query->sell_local_amount ?? 0.00;
            })->sum();

        return number_format((float)$balance, 2, '.', '') ?? 0.00;
    }

    public function InvoiceOwingAttribute()
    {
        if($this->outstandingBalanceAttribute() > 0.00)
        {
            return 'Outstanding';
        }

        return 'Settled';
    }

    public function GetDueDateAttribute()
    {
        $firstChargeLine = $this->chargeLines()->first();

        if($firstChargeLine)
        {
            if($firstChargeLine->sell_posted_due_date)
            {
                return Carbon::parse($firstChargeLine->sell_posted_due_date) ?? null;
            }

            return null;
        }


        return null;
    }

    public function GetCountDownAttribute()
    {
        if($this->InvoiceOwingAttribute() == 'Outstanding')
        {
            if($this->GetDueDateAttribute() !== null)
            {
                return Carbon::parse($this->GetDueDateAttribute())->diffForHumans();
            }
        }

        return 'Paid';
    }
}
