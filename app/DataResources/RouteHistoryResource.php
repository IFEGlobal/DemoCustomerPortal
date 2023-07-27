<?php

namespace App\DataResources;

use App\Models\Container;
use Illuminate\Support\Facades\Http;

class RouteHistoryResource
{
    public static function GetRouteHistory(Container $container)
    {
        $url = 'https://fyisolutions.co.uk/api/dataRequest/history';

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive'
        ];

        $packet = [
            'ClientDataIdentifier' => $container->id,
            'ContainerNumber' => $container->container_no,
        ];

        $request = Http::withHeaders($headers)->withBody(json_encode($packet), 'application/json')->post($url);
        $response = $request->getBody()->getContents();

        return json_decode($response, true) ?? null;
    }
}
