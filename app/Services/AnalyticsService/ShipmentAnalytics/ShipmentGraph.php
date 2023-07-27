<?php

namespace App\Services\AnalyticsService\ShipmentAnalytics;

use App\Models\Container;
use App\Models\ContainerDelivery;
use App\Models\Document;
use App\Models\Shipment;

class ShipmentGraph
{
    public $shipments;

    public function __construct()
    {
        $this->shipments = $this->AllShipments();
    }

    public function AllShipments()
    {
        $query = Shipment::with('containers')->get();

        return $query;
    }

    public function ShipmentGraphDataSet()
    {
        $dataset = array();

        $arrivals = $this->shipments->sortBy('estimated_arrival')->groupBy(function($date) {
            return \Illuminate\Support\Carbon::parse($date->estimated_arrival)->format('M Y');
        });

        $departures = $this->shipments->sortBy('estimated_departure')->groupBy(function($date) {
            return \Illuminate\Support\Carbon::parse($date->estimated_departure)->format('M Y');
        });

        $dataset['Stats'] = $this->CompileStats();

        $dataset['Graphs'] = $this->CompileDataset($arrivals,$departures);

        return $dataset;
    }

    public function CompileDataset($arrivals,$departures)
    {
        $dataByMonth = array();

        foreach($arrivals as $key => $data)
        {
            $dataByMonth[$key]['Month'] = $key;
            $dataByMonth[$key]['ArrivalTotal'] = $data->count() ?? 0;
            $dataByMonth[$key]['Arrivals']['Carriers'] = array_keys($this->CompileCarrierArrivalNumbers($data)) ?? [];
            $dataByMonth[$key]['Arrivals']['Values'] = array_values($this->CompileCarrierArrivalNumbers($data)) ?? [];
        }

        foreach ($departures as $key => $data) {
            $dataByMonth[$key]['Month'] = $key;
            $dataByMonth[$key]['DepartureTotal'] = $data->count() ?? 0;
            $dataByMonth[$key]['Departures']['Carriers'] = array_keys($this->CompileCarrierDepartureNumbers($data)) ?? [];
            $dataByMonth[$key]['Departures']['Values'] = array_values($this->CompileCarrierDepartureNumbers($data)) ?? [];
        }

        $dataByMonth['CarrierTotal'] = [array_keys($this->CalculateAllCarrier()),array_values($this->CalculateAllCarrier())];

        return $dataByMonth;
    }

    public function CompileCarrierArrivalNumbers($array)
    {
        $getCount = $array->groupBy('carrier')->map(function ($totals) {
            return $totals->count();
        });

        return $getCount->toArray();
    }

    public function CompileCarrierDepartureNumbers($array)
    {
        $getCount = $array->groupBy('carrier')->map(function ($totals) {
            return $totals->count();
        });

        return $getCount->toArray();
    }

    public function CalculateAllCarrier()
    {
        $carrierTotals = $this->AllShipments()->groupBy('carrier')->map(function ($totals) {
            return $totals->count();
        });

        return $carrierTotals->toArray();
    }

    public function CompileStats()
    {
        $stats = [
            'AllShipments' => $this->TotalShipmentsStat(),
            'LiveShipments' => $this->LiveShipmentStat(),
            'TotalContainers' => $this->TotalContainersStat(),
            'LiveContainers' => $this->LiveContainerStat(),
            'AverageVoyageDays' => $this->AverageVoyageDaysStat(),
            'AverageShipmentsMonthly' => $this->MonthlyAverageShipmentStat(),
            'AverageContainersMonthly' => $this->MonthlyAverageContainerStat(),
            'TotalCarriersUsed' => $this->TotalCarrierStat(),
            'TotalLiveDeliveries' => $this->LiveDeliveryStat(),
            'LiveDocuments' => $this->CountLiveDocuments(),
        ];

        return $stats;
    }

    public function TotalShipmentsStat()
    {
        return $this->shipments->count() ?? 0;
    }

    public function LiveShipmentStat()
    {
        return Shipment::query()->whereDate('estimated_arrival', '>', now())->orWhere(function($delivery) {
            $delivery->whereHas('containerDeliveries', function ($limit) {
                $limit->where('arrival_estimated_delivery', '>', now());
            });
        })->count() ?? 0;
    }

    public function TotalContainersStat()
    {
        $countContainers = $this->shipments->map(function ($containers) {
            return $containers->containers->count();
        })->sum();

        return $countContainers ?? 0;
    }

    public function LiveContainerStat()
    {
        $liveContainerCount = $this->shipments->where('estimated_arrival', '>', now())->map(function ($containers) {
            return $containers->containers->count();
        })->sum();

        return $liveContainerCount ?? 0;
    }

    public function MonthlyAverageShipmentStat()
    {
        $average = $this->shipments->groupBy(function($date) {
            return \Illuminate\Support\Carbon::parse($date->estimated_arrival)->format('m');
        })->map(function($count){
            return $count->count();
        })->average();

        return number_format((float)$average, 2, '.', '') ?? 0;
    }

    public function MonthlyAverageContainerStat()
    {
        $average = $this->shipments->groupBy(function($date)
        {
            return \Illuminate\Support\Carbon::parse($date->estimated_arrival)->format('m');
        })->map(function($shipments) {
            return $shipments->map(function ($container){
                return $container->containers;
            })->count();
        })->average();

        return number_format((float)$average, 2, '.', '') ?? 0;
    }

    public function AverageVoyageDaysStat()
    {
        $averageVoyageDays = $this->shipments->map(function($average){
            if(($average->estimated_departure !== null) && ($average->estimated_arrival !== null))
            {
                $days = $average->estimated_departure->diffInDays($average->estimated_arrival);
            }
            else
            {
                $days = 0;
            }

            return $days;
        })->average();

        return number_format((float)$averageVoyageDays, 2, '.', '') ?? 0;
    }

    public function TotalCarrierStat()
    {
        $totalCarrier = count(array_unique(array_keys($this->CalculateAllCarrier())));

        return $totalCarrier ?? 0;
    }

    public function LiveDeliveryStat()
    {
        return ContainerDelivery::query()->where('arrival_estimated_delivery', '>', now())->whereHas('shipment')->count() ?? 0;
    }

    public function RoutesByDays()
    {
        $routeDays = $this->shipments->groupBy(function ($pairs)
        {
            return $pairs->loading_port_name.' to '.$pairs->disc_port_name;})->map(function ($shipment)
            {
                $average = $shipment->groupBy('carrier')->map(function($days){
                    $byCarrier = $days->map(function($test){
                        return $test->estimated_departure->diffInDays($test->estimated_arrival);
                    })->average();
                    return $byCarrier;
                });
                return [array_keys($average->toArray()), array_values($average->toArray())];
            });

        return $routeDays ?? 0;
    }

    public function CountLiveDocuments()
    {
        return Document::query()->whereHas('shipment', function ($limit){
            $limit->whereDate('estimated_arrival', '>', now());
        })->count();
    }
}
