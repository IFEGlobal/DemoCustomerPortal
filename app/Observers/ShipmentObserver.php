<?php

namespace App\Observers;

use App\Jobs\AutomatedShipmentEvent;
use App\Models\Shipment;

class ShipmentObserver
{

    public function created(Shipment $shipment)
    {
//        AutomatedShipmentEvent::dispatch($shipment);
    }


    public function updated(Shipment $shipment)
    {
//        AutomatedShipmentEvent::dispatch($shipment);
    }


    public function deleted(Shipment $shipment)
    {
        //
    }


    public function restored(Shipment $shipment)
    {
        //
    }

    public function forceDeleted(Shipment $shipment)
    {
        //
    }
}
