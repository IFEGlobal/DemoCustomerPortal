<?php

namespace App\Http\Livewire;

use App\Charts\ShipmentsChart;
use Livewire\Component;

class TestAnalytics extends Component
{
    public function render(ShipmentsChart $chart)
    {
        return view('livewire.test-analytics', ['chart' => $chart->build()]);
    }
}
