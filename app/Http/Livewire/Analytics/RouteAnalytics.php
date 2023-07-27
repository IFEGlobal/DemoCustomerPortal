<?php

namespace App\Http\Livewire\Analytics;

use App\Services\AnalyticsService\ShipmentAnalytics\ShipmentsAnalytics;
use Livewire\Component;

class RouteAnalytics extends Component
{
    public $routeSummary;

    public $totalVoyages;

    public $routeAverage = null;

    public $carriersUsed = null;

    public $routeName = null;

    protected $listeners = ['showAnalytics', 'ClearFilter', 'SetRoute'];

    public function mount()
    {
        $shipmentAnalyticsService =  new ShipmentsAnalytics();
        $this->routeSummary = $shipmentAnalyticsService->RoutesByDays();

        $this->totalVoyages = $this->routeSummary->map(function ($cal) {
            return array_sum($cal[2]) ?? 1;
        })->sum();
    }

    public function setCardData($route)
    {
        $this->routeAverage = round(array_sum($this->routeSummary[$route][1])/count($this->routeSummary[$route][2])) ?? '';

        $this->carriersUsed = count($this->routeSummary[$route][0]) ?? 0;

        $this->routeName = $route;

        $this->emitTo('analytics.shipment-analytics-table', 'SetRoute', explode("to ", $this->routeName));

        $this->dispatchBrowserEvent('updateRouteChart', json_encode($this->routeSummary[$route]));
    }

    public function ClearFilter()
    {
        $this->routeAverage = null;

        $this->carriersUsed = null;

        $this->routeName = null;
    }

    public function showAnalytics($route)
    {
        $data = array_filter($this->routeSummary->toArray(), function($key) use ($route) {return $key == $route;}, ARRAY_FILTER_USE_KEY);

        foreach($data as $format)
        {
            $reformat[] = $format;
        }

        $this->dispatchBrowserEvent('generatePerRouteAnalysis', ['data' => $reformat]);
    }

    public function render()
    {
        return view('livewire..analytics.route-analytics');
    }
}
