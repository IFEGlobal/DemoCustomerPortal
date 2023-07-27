<?php

namespace App\Http\Livewire\Analytics;

use App\Models\Shipment;
use App\Services\AnalyticsService\ShipmentAnalytics\ShipmentsAnalytics;
use Illuminate\Support\Arr;
use Livewire\Component;

class PerShipmentAnalyticsCard extends Component
{
    public $record = null;

    public ?int $teu = null;

    public ?string $routeAvg = null;

    public ?string $transitTime = null;

    public ?string $routeOccurances = null;

    public ?array $perShipmentDataset = null;

    protected $listeners = ['clickedShipment'];

    public function render()
    {
        return view('livewire..analytics.per-shipment-analytics-card');
    }

    public function clickedShipment($id)
    {
        $this->emit('refreshComponent');

        $shipment = Shipment::with('containers')->where('id', $id)->with('containers')->first();

        if($shipment)
        {
            $this->getTEU($shipment);

            $this->clientRouteAverage($shipment);

            $this->getTransitTime($shipment);

            $this->record = $shipment;
        }
    }

    public function getTEU(Shipment $shipment)
    {
        if($shipment->has('containers'))
        {
            $data = $shipment->containers->map(function ($teu) {
                if($teu->container_type == null)
                {
                    $calculateTeu = 0;
                }

                if($teu->container_type == "20GP")
                {
                    $calculateTeu = 1;
                }

                if($teu->container_type == "20HC")
                {
                    $calculateTeu = 1.25;
                }

                if($teu->container_type == "40GP")
                {
                    $calculateTeu = 2;
                }

                if($teu->container_type == "40HC")
                {
                    $calculateTeu = 2.25;
                }

                return $calculateTeu;
            })->sum();

            $this->teu = $data;
        }
    }

    public function getTransitTime(Shipment $shipment)
    {
        if((!is_null($shipment->estimated_arrival)) && (!is_null($shipment->estimated_departure)))
        {
            $days = $shipment->estimated_departure->diffInDays($shipment->estimated_arrival);

            $this->transitTime = $days;

        } else {
            $this->transitTime = 0;
        }
    }

    public function clientRouteAverage(Shipment $shipment)
    {
        $findMathcingRoutes = Shipment::where('loading_port_code', $shipment->loading_port_code)
            ->where('disc_port_code', $shipment->disc_port_code)
            ->where('estimated_arrival', '!=', null)
            ->where('estimated_departure', '!=', null)
            ->get();

        $average = $findMathcingRoutes->map(function($route) {return $route->estimated_departure->diffInDays($route->estimated_arrival);})->average();

        $this->routeAvg = round($average) ?? 0;

        $this->routeOccurances = $findMathcingRoutes->count() ?? 0;

        $this->getRouteDaysGraphData($findMathcingRoutes);
    }

    public function getRouteDaysGraphData($collection)
    {
        $departures = $collection->groupBy(function ($date) {
            return \Illuminate\Support\Carbon::parse($date->estimated_departure)->format('M-Y');
        });

        foreach($departures as $key => $shipments)
        {
            $result[$key] = [
                'Month' => $key,
                'Days' => $shipments->map(function($average)
                {return $average->estimated_departure->diffInDays($average->estimated_arrival);})->average(),
            ];

            $result[$key]['Carriers'][] = $shipments->map(function($carriers)
            {
                $carrier['Carrier'] = $carriers->carrier ?? 'None';
                $carrier['Shipment'] = $carriers->shipment_ref ?? 'None';
                $carrier['Days'] = $carriers->estimated_departure->diffInDays($carriers->estimated_arrival) ?? 0;
                return $carrier;
            })->toArray();
        }

        foreach($result as $data)
        {
            $response[] = $data;
        }

        if(isset($response))
        {$this->perShipmentDataset = $response;
        } else {$this->perShipmentDataset = ['Month' => [], 'Avg' => 0, 'Carrier' => 'None'];
        }

        $this->dispatchBrowserEvent('refreshComponent', ['data' => $this->perShipmentDataset]);
    }
}
