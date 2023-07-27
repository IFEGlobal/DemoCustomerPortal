<?php

namespace App\Observers;

use App\Models\AccessActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccessObserver
{

    public function created(AccessActivity $accessAcitivity)
    {
        //
    }

    public function updated(AccessActivity $accessAcitivity)
    {

    }


    public function deleted(AccessActivity $accessAcitivity)
    {

    }


    public function restored(AccessActivity $accessAcitivity)
    {
        //
    }


    public function forceDeleted(AccessActivity $accessAcitivity)
    {
        //
    }
}
