<?php

namespace App\Models;

use App\Scopes\PriorityScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prioratable_id',
        'prioratable_type',
        'prioratable_reference',
    ];

    protected $connection = 'mysql';

    protected static function booted()
    {
        static::addGlobalScope(new PriorityScope);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
