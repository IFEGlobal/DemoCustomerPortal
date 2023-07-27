<?php

namespace App\Services\DataService;

use App\Models\Container;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class GetVesselPosition
{
    public $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function CreatePacket()
    {
        if($this->container->shipment->vessel == null)
        {
            return null;
        }

        if($this->container->shipment->estimated_arrival > now())
        {
            $packet = ['vessel' => $this->container->shipment->vessel];
            return $this->SendPacket($packet);
        }

        return null;
    }

    public function SendPacket($packet)
    {
        $service = new ForwarderMiddleware($this->container->returnUrl().'/api/shipments/position', $packet);

        return $service->SendData();
    }
}
