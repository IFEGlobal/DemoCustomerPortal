<?php

namespace App\Models;

use App\Scopes\FavoriteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected static function booted()
    {
        static::addGlobalScope(new FavoriteScope);
    }

    protected $fillable = [
        'user_id',
        'favorable_id',
        'favorable_reference',
        'favorable_type',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
