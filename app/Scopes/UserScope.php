<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(Auth::hasUser()){
            $builder->whereHas('access', function ($user){
                $user->whereIn('client_code', Auth::user()->access->pluck('client_code')->toArray());
            });
        }
    }
}
