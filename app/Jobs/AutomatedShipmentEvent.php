<?php

namespace App\Jobs;

use App\Models\Shipment;
use App\Models\User;
use App\Services\OutboundService\ShipmentEventOutboundService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutomatedShipmentEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $shipment;

    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }


    public function handle()
    {
        $codes = [$this->shipment->consignee_code, $this->shipment->consignor_code, $this->shipment->local_client_code];

        $users = User::whereHas('access', function($limit) use ($codes){
            $limit->whereIn('client_code', $codes);
        })->whereHas('outboundServices')->with('outboundServices')->get();

        if($users)
        {
            $service = new ShipmentEventOutboundService($this->shipment, $users, $this->job->getJobId());
            $service->GetServices();
        }
    }
}
