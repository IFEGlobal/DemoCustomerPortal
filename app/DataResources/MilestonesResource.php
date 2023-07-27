<?php

namespace App\DataResources;

use App\Models\Container;
use Illuminate\Support\Facades\Http;

class MilestonesResource
{
    public static function GetMilestones(Container $container)
    {
        $url = 'https://fyisolutions.co.uk/api/dataRequest/milestones';

        $packet = [
          'ClientDataIdentifier' => $container->id,
          'ContainerNumber' => $container->container_no,
        ];

        $request = Http::withBody(json_encode($packet), 'application/json')->post($url);

        if($request->failed()) {
            return null;
        } else {
            $response = $request->getBody()->getContents();
        }

        return json_decode($response, true) ?? null;
    }
}
