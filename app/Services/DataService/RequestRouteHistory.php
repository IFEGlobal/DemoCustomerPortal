<?php

namespace App\Services\DataService;

use App\DataResources\RouteHistoryResource;
use App\Models\Container;
use Illuminate\Support\Arr;

class RequestRouteHistory
{
    public $container;

    public $scheduledData;

    public $plannedData;

    public $actualData;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function RetrieveHistory()
    {
        $history = $this->container->route_history ?? RouteHistoryResource::GetRouteHistory($this->container);

        if($history !== null)
        {
            $this->FirstEntry($history);

            $this->PlannedEntry($history);

            $this->LastEntry($history);

            return $this->ReturnData();
        }

        return $this->FakeHistory();
    }

    public function FirstEntry($history)
    {
        $loadedEntry = Arr::first($history);

        $this->scheduledData['Departure'] = $loadedEntry['EstimatedDeparture'] ?? 'Pending';
        $this->scheduledData['Arrival'] = $loadedEntry['PortArrival'] ?? $loadedEntry['EstimatedArrival'] ?? null;
    }

    public function PlannedEntry($history)
    {
        if(count($history) < 2)
        {
            $this->plannedData['Departure'] = $history[0]['EstimatedDeparture'];
            $this->plannedData['Arrival'] = 'Pending';
        } else {
            $this->plannedData['Departure'] = $history[1]['EstimatedDeparture'] ?? 'Pending';
            $this->plannedData['Arrival'] = $history[1]['PortArrival'] ?? $history[1]['EstimatedArrival'] ?? 'Pending';
        }
    }

    public function LastEntry($history)
    {
        $latestEntry = Arr::last($history);

        if(count($history) < 2)
        {
            $this->actualData['Departure'] = $latestEntry['EstimatedDeparture'] ?? $history[array_key_last($history) - 1]['EstimatedDeparture'] ?? 'Unknown';
        } else {
            $this->actualData['Departure'] = $latestEntry['EstimatedDeparture'] ?? 'Pending';

            if($latestEntry['PortArrival'] == null) {
                if($latestEntry['EstimatedArrival'] !== null && $latestEntry['EstimatedArrival'] < now()->subDay()){
                    $this->actualData['Arrival'] = $latestEntry['EstimatedArrival'] ?? 'Pending';
                }
            } elseif($latestEntry['PortArrival'] <= now()) {
                $this->actualData['Arrival'] = $latestEntry['PortArrival'] ?? 'Pending';
            } else {
                $this->actualData['Arrival'] = null;
            }
        }
    }

    public function ReturnData()
    {
        return [
            'scheduled' =>$this->scheduledData,
            'planned' => $this->plannedData,
            'actual' => $this->actualData
        ];
    }


    public function FakeHistory()
    {
        return null;
    }
}
