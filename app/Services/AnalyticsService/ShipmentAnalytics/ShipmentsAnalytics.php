<?php

namespace App\Services\AnalyticsService\ShipmentAnalytics;

use App\Models\Container;
use App\Models\Shipment;
use Illuminate\Support\Arr;

class ShipmentsAnalytics
{
    public $shipments;

    public $containers;


    public function __construct()
    {
        $this->shipments = $this->AllShipments();
    }

    public function AllShipments()
    {
        $query = Shipment::with('containers')->orderBy('estimated_departure', 'asc')
            ->whereYear('estimated_departure', '>', now()->subYears(2))
            ->get();

        return $query;
    }

    public function ShipmentMonthlyGraphDataSet()
    {
        $dataset = array();

        $arrivals = $this->shipments->groupBy(function ($date) {
            return \Illuminate\Support\Carbon::parse($date->estimated_arrival)->format('M y');
        });

        $departures = $this->shipments->groupBy(function ($date) {
            return \Illuminate\Support\Carbon::parse($date->estimated_departure)->format('M y');
        });

        $dataset['Graphs'] = $this->CompileMonthlyDataset($arrivals,$departures);

        return $dataset;
    }

    public function CompileMonthlyDataset($arrivals,$departures)
    {
        $dataByMonth = array();

        foreach ($departures as $key => $data) {

            $dataByMonth[$key]['Month'] = $key;
            $dataByMonth[$key]['DepartureTotal'] = $data->count() ?? 0;
            $dataByMonth[$key]['Departures']['Carriers'] = array_keys($this->CompileCarrierDepartureNumbers($data)) ?? null;
            $dataByMonth[$key]['Departures']['Values'] = array_values($this->CompileCarrierDepartureNumbers($data)) ?? 0;
            $dataByMonth[$key]['Departures']['TEUCarriers'] = array_values($this->GetTEUByMonth($data)['TEUCarrier']) ?? 'None';
            $dataByMonth[$key]['Departures']['TEU'] = array_values($this->GetTEUByMonth($data)['TEU'] ?? 0);
            $dataByMonth[$key]['DeparturesTEUTotal'] = array_sum(array_values($this->GetTEUTotals($data) ?? 0));
            $dataByMonth[$key]['WeeklyDepartures'] = $this->ShipmentWeeklyGraphDataSet('Departure', $data);
        }

        foreach($arrivals as $key => $data) {
            $dataByMonth[$key]['Month'] = $key;
            $dataByMonth[$key]['ArrivalTotal'] = $data->count() ?? 0;
            $dataByMonth[$key]['Arrivals']['Carriers'] = array_keys($this->CompileCarrierArrivalNumbers($data)) ?? null;
            $dataByMonth[$key]['Arrivals']['Values'] = array_values($this->CompileCarrierArrivalNumbers($data)) ?? 0;
            $dataByMonth[$key]['Arrivals']['TEUCarriers'] = array_values($this->GetTEUByMonth($data)['TEUCarrier']) ?? 'None';
            $dataByMonth[$key]['Arrivals']['TEU'] = array_values($this->GetTEUByMonth($data)['TEU'] ?? 0);
            $dataByMonth[$key]['ArrivalsTEUTotal'] = array_sum(array_values($this->GetTEUTotals($data) ?? 0));
            $dataByMonth[$key]['WeeklyArrivals'] = $this->ShipmentWeeklyGraphDataSet('Arrival', $data);
        }

        return $this->AddJSDataValidation($dataByMonth);
    }

    public function AddJSDataValidation($dataByMonth)
    {
        foreach($dataByMonth as $key => $jsValidation)
        {
            if(!isset($jsValidation['Departures']))
            {
                $dataByMonth[$key]['DepartureTotal'] =  0;
                $dataByMonth[$key]['Departures']['Carriers'] = ['None'];
                $dataByMonth[$key]['Departures']['Values'] = [0];
            }

            if(!isset($jsValidation['Arrivals']))
            {
                $dataByMonth[$key]['ArrivalTotal'] = 0;
                $dataByMonth[$key]['Arrivals']['Carriers'] = ['None'];
                $dataByMonth[$key]['Arrivals']['Values'] = [0];
            }

            if(!isset($jsValidation['Arrivals']['TEU']))
            {
                $dataByMonth[$key]['Arrivals']['TEU'] = [0];
            }

            if(!isset($jsValidation['Departures']['TEU']))
            {
                $dataByMonth[$key]['Departures']['TEU'] = [0];
            }

            if(!isset($jsValidation['Arrivals']['TEUCarriers']))
            {
                $dataByMonth[$key]['Arrivals']['TEUCarriers'] = ['None'];
            }

            if(!isset($jsValidation['Departures']['TEUCarriers']))
            {
                $dataByMonth[$key]['Departures']['TEUCarriers'] = ['None'];
            }

            if(!isset($jsValidation['WeeklyDepartures']))
            {
                $jsValidation['WeeklyDepartures'] = ['Week' => [], 'TEU' => 0];
            }
        }

        $dataByMonth['CarrierTotal'] = [array_keys($this->CalculateAllCarrier()),array_values($this->CalculateAllCarrier())];

        return $dataByMonth;
    }

    public function ShipmentWeeklyGraphDataSet($type, $collection)
    {
        $dataset = array();

        if($type = 'Departure')
        {
            $compile = $collection->groupBy(function ($date) {
                return 'Week '.\Illuminate\Support\Carbon::parse($date->estimated_arrival)->format('W Y');
            });
        }

        if($type = 'Arrival')
        {
            $compile = $collection->groupBy(function ($date) {
                return 'Week '.\Illuminate\Support\Carbon::parse($date->estimated_departure)->format('W Y');
            });
        }

        if(isset($compile))
        {
            return$this->CompileWeeklyDataset($compile);
        }

        return null;
    }

    public function CompileWeeklyDataset($collection)
    {
        $data = $collection->mapWithKeys(function ($byWeek, $key){
            $cal['Weeks'][$key] = ['Week' => [$key], 'TEU' => $this->GetTEUTotals($byWeek)];
            return $cal;
        });

        return $data;
    }

    public function CompileCarrierArrivalNumbers($array)
    {
        $getCount = $array->groupBy('carrier')->map(function ($totals) {return $totals->count();});

        return $getCount->toArray();
    }

    public function CompileCarrierDepartureNumbers($array)
    {
        $getCount = $array->groupBy('carrier')->map(function ($totals) {return $totals->count();});

        return $getCount->toArray();
    }

    public function CalculateAllCarrier()
    {
        $carrierTotals = $this->AllShipments()->groupBy('carrier')->map(function ($totals) {return $totals->count();});

        return $carrierTotals->toArray();
    }

    public function GetTEUByMonth($data)
    {
        $data = $this->CompileShipmentTEU($data);

        foreach($data as $order)
        {
            $sortedData = ['TEUCarrier' => array_keys($order->toArray()), 'TEU' => array_values($order->toArray())];
        }

        if(!isset($sortedData))
        {
            $sortedData = ['TEUCarrier' => 'None', 'TEU' => 0];
        }

        return $sortedData;
    }

    public function GetTEUTotals($data)
    {
        $data = $this->CompileShipmentTEU($data);

        return  Arr::flatten($data);
    }

    public function CompileShipmentTEU($collection)
    {
        $data[] = $collection->groupBy(function ($carrier) {return $carrier->carrier;})
            ->map(function($shipment)
            {
                return $shipment->map(function ($container) {
                    return $container->containers->map(function ($teu){
                        return (preg_replace("/[^0-9]/", "", $teu->container_type)/20) ?? 0;
                    })->sum();
                })->sum();
            });

        return $data;
    }

    public function GetAverageContainersPerShipment()
    {
        $average = $this->shipments->map(function ($containers){
            return $containers->containers->count();
        })->average();

        return number_format((float)$average, 2, '.', '');
    }

    public function GetAverageShipmentsPerMonth()
    {

    }

    public function RoutesByDays()
    {
        $routeDays = $this->shipments->groupBy(function ($pairs) {return $pairs->loading_port_name.' to '.$pairs->disc_port_name;})->map(function ($shipment)
            {
                $average = $shipment->groupBy('carrier')->map(function($days)
                {
                    $byCarrier = $days->map(function($shipment) {
                        return $shipment->estimated_departure->diffInDays($shipment->estimated_arrival);
                    })->average();

                    return $byCarrier;
                });

                $totals = $shipment->groupBy('carrier')->map(function($days) {
                    return $days->count();
                });

                $teu = $shipment->groupBy('carrier')->map(function($teu) {
                    $byTEU = $teu->map(function ($container) {
                        return $container->containers->map(function ($getTEU){

                            if($getTEU->container_type == null)
                            {
                                $calculateTeu = 0;
                            }

                            if($getTEU->container_type == "20GP")
                            {
                                $calculateTeu = 1;
                            }

                            if($getTEU->container_type == "20HC")
                            {
                                $calculateTeu = 1.25;
                            }

                            if($getTEU->container_type == "40GP")
                            {
                                $calculateTeu = 2;
                            }

                            if($getTEU->container_type == "40HC")
                            {
                                $calculateTeu = 2.25;
                            }

                            return $calculateTeu ?? 0;

                        })->sum();
                    })->sum();

                    return $byTEU;
                });

                return [array_keys($average->toArray()) ?? [], array_values($average->toArray()) ?? [], $totals->toArray() ?? [],$teu->toArray() ?? []];
            });


        return $routeDays ?? 0;
    }


}
