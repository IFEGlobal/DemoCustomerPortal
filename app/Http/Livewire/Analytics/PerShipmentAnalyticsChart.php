<?php

namespace App\Http\Livewire\Analytics;

use Livewire\Component;

class PerShipmentAnalyticsChart extends Component
{

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.analytics.per-shipment-analytics-chart');
    }
}
