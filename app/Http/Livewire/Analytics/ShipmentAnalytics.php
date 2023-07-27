<?php

namespace App\Http\Livewire\Analytics;

use App\Services\AnalyticsService\ShipmentAnalytics\ShipmentsAnalytics;
use Livewire\Component;

class ShipmentAnalytics extends Component
{
    public function render()
    {
        $shipmentAnalyticsService =  new ShipmentsAnalytics();
        $monthlyChart = $shipmentAnalyticsService->ShipmentMonthlyGraphDataSet();

        return view('livewire..analytics.shipment-analytics', [
            'MonthlyShipmentsChart' => $monthlyChart,
        ]);
    }
}
