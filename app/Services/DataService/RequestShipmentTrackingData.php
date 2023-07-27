<?php

namespace App\Services\DataService;

use App\Models\Container;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class RequestShipmentTrackingData
{
    public $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function CreatePacket()
    {
        $packet = [
            'Client' => $this->container->shipment->consignee_name ?? $this->container->shipment->consignor_name,
            'ShipmentReference' => $this->container->shipment->shipment_ref,
            'ContainerNumber' => $this->container->container_no,
        ];

        return $this->SendPacket($packet);
    }

    public function SendPacket($packet)
    {
        $service = new ForwarderMiddleware($this->container->returnUrl().'/api/shipments/milestones', $packet);
        return $service->SendData();
    }

}
