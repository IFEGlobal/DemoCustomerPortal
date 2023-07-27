<?php

namespace App\DataResources;

use App\Models\Shipment;
use Illuminate\Support\Facades\Http;

class PolylineResource
{
    public static function GetPolyline(Shipment $shipment)
    {

        $url = 'https://fyisolutions.co.uk/api/location/request/polyline';

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
            'x-api-key' => '9b7110af-b03e-4fc0-a648-acae6ba70e13'
        ];

        $packet = [
            'from' => [
                'port_code' => $shipment->loading_port_code ?? null,
                'port_name' => $shipment->loading_port_name ?? null,
            ],
            'to' => [
                'port_code' => $shipment->disc_port_code ?? null,
                'port_name' => $shipment->disc_port_name ?? null,
            ],
        ];

        $request = Http::timeout(15)->withHeaders($headers)->withBody(json_encode($packet), 'application/json')->post($url);

        if($request->failed()) {
            return null;
        } else {
            $response = $request->getBody()->getContents();
        }

        return json_decode($response, true) ?? null;
    }
}
