<?php

namespace App\Services\DataService;

use App\DataResources\PolylineResource;
use App\Models\Container;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class RequestShipmentRouteData
{
    public $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function CreatePacket()
    {
        $packet = [
            'from' => [
                'port_code' => $this->container->shipment->loading_port_code ?? null,
                'port_name' => $this->container->shipment->loading_port_name ?? null,
            ],
            'to' => [
                'port_code' => $this->container->shipment->disc_port_code ?? null,
                'port_name' => $this->container->shipment->disc_port_name ?? null,
            ],
        ];

        return $this->SendPacket($packet);
    }

    public function SendPacket($packet)
    {
        return PolylineResource::GetPolyline($packet);
    }


}
