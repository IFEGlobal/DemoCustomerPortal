<?php

namespace App\DataResources;

use App\Models\Container;
use App\Models\Shipment;
use Illuminate\Support\Facades\Http;

class VesselPostionResource
{
    public static function GetVesselPosition(Container $container)
    {
        if($container->shipment->vessel == null)
        {
            return null;
        }

        if($container->shipment->estimated_arrival > now()->addHours(23))
        {
            $url = 'https://fyisolutions.co.uk/api/location/request/vessel';

            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => '*/*',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Connection' => 'keep-alive'
            ];

            $packet = ['vessel' => FindCurrentVesselResource::FindCurrentVessel($container)];

            $request = Http::withHeaders($headers)->withBody(json_encode($packet), 'application/json')->post($url);
            $response = $request->getBody()->getContents();


            return json_decode($response) ?? null;

        }

        return null;
    }
}
