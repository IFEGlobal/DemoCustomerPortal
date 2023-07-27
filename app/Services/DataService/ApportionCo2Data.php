<?php

namespace App\Services\DataService;

use App\Models\Container;
use Illuminate\Support\Arr;

class ApportionCo2Data
{
    public $container;

    public $Co2Data;

    public $totalWeight;

    public function __construct(Container $container, $Co2Data)
    {
        $this->container = $container;

        $this->Co2Data = $Co2Data;
    }

    public function GetTotalCarbonEmissions()
    {
        $emissions = Arr::get($this->Co2Data,'co2e', null);

        if($emissions !== null){
            $data = [
                'wtt' => $emissions['wtt'] ?? null,
                'ttw' => $emissions['ttw'] ?? null,
                'total' => $emissions['total'] ?? null,
                'weight' => (int)$this->container->gross_weight ?? 0
            ];
        }

        if(isset($data)){
            return $this->GetTotalWeight($data);
        }

        return null;
    }

    public function GetTotalWeight($data)
    {
        $shipment = $this->container->shipment;

        $totalWeight = (int)$shipment->containers()->sum('gross_weight') ?? 0;

        return $this->SetApportionPercentage($data,$totalWeight);
    }

    public function SetApportionPercentage($data,$totalWeight)
    {
        if($data['weight'] !== null && $data['weight'] > 0 && $totalWeight !== null && $totalWeight > 0){
            $percentage = ($data['weight']/$totalWeight);

            if(isset($percentage)){
                return $this->ApportionCo2($data,$percentage);
            }

            return null;
        }

        return null;
    }

    public function ApportionCo2($data,$percentage)
    {
        $apportionedData = [
            'ApportionedCO2EWellToTank' => round((($data['wtt'] * $percentage)/1000),2) ?? 0,
            'ApportionedCO2ETankToWheel' => round((($data['ttw'] * $percentage)/1000),2) ?? 0,
            'ApportionedCO2ETotal' => round((($data['total'] * $percentage)/1000),2) ?? 0,
        ];

        return $apportionedData;
    }

}
