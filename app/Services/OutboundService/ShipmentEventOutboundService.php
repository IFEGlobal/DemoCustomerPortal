<?php

namespace App\Services\OutboundService;

use App\Models\Events;
use App\Services\APIService\ShipmentAPIRequests;
use Illuminate\Support\Facades\Http;

class ShipmentEventOutboundService
{
    public $shipment;

    public $users;

    public $JobID;

    public function __construct($shipment, $users, $jobID)
    {
        $this->shipment = $shipment;

        $this->users = $users;

        $this->JobID = $jobID;
    }

    public function GetServices()
    {
        foreach($this->users as $user)
        {
            foreach($user->outboundServices as $key => $credentials)
            {
                $this->UniqueServices($credentials);
            }
        }
    }

    public function UniqueServices($service)
    {
        $headers = $this->GenerateHeaders($service);

        $event = $this->GenerateJsonData();

        $request = Http::withHeaders($headers)->withBody(json_encode($event), 'application/json')->withoutVerifying()->post($service->service_url);
        $response = $request->getBody()->getContents();
        $status = $request->getStatusCode();

        $this->LogEvent($response,$status,$service,$event,$this->shipment->shipment_ref);
    }

    public function GenerateJsonData()
    {
        $request = ['ShipmentRef' => $this->shipment->shipment_ref];

        $service = new ShipmentAPIRequests();

        return $service->RequestContainers($request);
    }

    public function GenerateHeaders($service)
    {
        if($service->service_username !== null)
        {
            $auth = [$service->service_username ?? null.' '.$service->service_password ?? null];
        }

        if($service->service_token !== null)
        {
            $auth = $service->token_type.' '.$service->service_token ?? null;
        }

        return [
            'Authorization' => $auth ?? null,
            'Content-Type' => 'application/json',
            'Accept-Encoding' => 'gzip, deflate, br',
        ];
    }

    public function LogEvent($response, $status,$service,$event,$type)
    {
        Events::create([
            'event_registration_id' => $service->id,
            'event_type' => $type,
            'event' => $event,
            'event_sent' => now(),
            'response_status' => $status,
            'response_string' => $response,
        ]);

        return 'Event Created Successfully';
    }
}
