<?php

namespace App\Http\Livewire\Analytics;

use App\Services\AnalyticsService\ShipmentAnalytics\ShipmentGraph;
use App\Services\AnalyticsService\ShipmentAnalytics\ShipmentsAnalytics;
use Livewire\Component;

class MyAnalytics extends Component
{
    public function render()
    {
        return view('livewire..analytics.my-analytics');
    }
}
