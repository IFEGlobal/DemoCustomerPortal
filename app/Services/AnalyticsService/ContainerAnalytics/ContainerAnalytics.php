<?php

namespace App\Services\AnalyticsService\ContainerAnalytics;

use App\Models\Container;

class ContainerAnalytics
{
    public ?array $allContainers;


    public function __construct()
    {
        $this->allContainers = $this->AllContainersQuery();
    }

    public function AllContainersQuery()
    {
        $containers = Container::orderBy('estimated_arrival', 'asc')->get();

        return $containers;
    }

    public function LiveContainers()
    {
        $liveContainers = $this->allContainers->where(function ($query){
           $query->where('estimated_arrival', '>', now()->subDays(1))
           ->orWhereHas('containerDelivery',function ($delivery){
               $delivery->where('arrival_estimated_delivery', '>', now()->subDays(1));
            });
        });

        return $liveContainers;
    }

    public function GetAverageContainersPerShipment()
    {

    }


}
