<?php

namespace App\DataResources;

use Illuminate\Support\Facades\Http;

class Co2Resource
{
    public static function GetC02Data($id,$url)
    {
        $urlAddress = $url.'/api/Co2Request';

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive'
        ];

        $packet = ['ShipmentId' => $id];

        try{
            $request = Http::timeout(15)->withHeaders($headers)->withBody(json_encode($packet), 'application/json')->post($urlAddress);

            if($request->successful()) {
                $response  = $request->getBody()->getContents();
                return json_decode($response, true) ?? null;
            }

            return null;

        } catch (\Exception $e){
            return null;
        }
    }
}
