<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'company_name',
        'ownership_reference',
        'api_url',
        'schema',
        'service_status',
    ];

    protected $casts = [
        'service_status' => 'boolean',
    ];

    public function accessList(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Access::class);
    }

    public function shipments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}
