<?php

namespace App\DataResources;

use App\Models\Shipment;
use Illuminate\Support\Facades\Http;

class OutstandingBalanceResource
{
    public static function UpdateOutstandingBalance($shipment_id)
    {
        $shipment = Shipment::find($shipment_id);

        if($shipment)
        {
            return self::SendBalanceRequest($shipment);
        }

        return 'No Shipment Found';
    }

    public static function SendBalanceRequest(Shipment $shipment)
    {
        $packet = [
            'ShipmentReference' => $shipment->shipment_ref,
            'ShipmentId' => $shipment->id
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive'
        ];

        $request = Http::withHeaders($headers)->withBody(json_encode($packet), 'application/json')->post($shipment->returnUrl().'/api/outstandingBalance');

        $response = $request->getBody()->getContents();
    }
}
