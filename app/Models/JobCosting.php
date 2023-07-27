<?php

namespace App\Models;

use App\Scopes\InvoiceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCosting extends Model
{
    use HasFactory;

    protected $connection = 'onthefly';

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new InvoiceScope);
    }

    public function shipment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobInvoicing::class, 'job_costing_id', 'id');
    }

    public function latestInvoice(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(JobInvoicing::class, 'job_costing_id', 'id')->where('sell_fully_paid_date', '=',null)->latest();
    }

    public function invoiceNumber(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(JobInvoicing::class, 'job_costing_id', 'id')->latest();
    }

    public function outstandingAmountAttribute()
    {
        return $this->latestInvoice()->pluck('sell_outstanding_amount');
    }
}
