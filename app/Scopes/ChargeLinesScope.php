<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ChargeLinesScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(Auth::hasUser()){
            $builder->whereHas('shipment', function ($query) {
                $query->whereIn('consignee_code', Auth::user()->access->pluck('client_code')->toArray())
                    ->orWhere(function ($query2) {
                        $query2->whereIn('consignor_code', Auth::user()->access->pluck('client_code')->toArray())
                            ->orWhereIn('local_client_code', Auth::user()->access->pluck('client_code')->toArray());
                    });
            });
        }
    }
}
