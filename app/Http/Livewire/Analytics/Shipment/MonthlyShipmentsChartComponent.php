<?php

namespace App\Http\Livewire\Analytics\Shipment;

use App\Models\Shipment;
use App\Services\AnalyticsService\ShipmentAnalytics\ShipmentsAnalytics;
use Illuminate\Support\Str;
use Livewire\Component;

class MonthlyShipmentsChartComponent extends Component
{
    public $data;

    public $arrivals;

    public $departures;

    public $departureTEU;

    public $arrivalTEU;

    public $teuCarrierCount;

    public $teuCarrierJourneys;

    public $totalCarrierTransit;

    public $currentMonth = null;

    protected $listeners = ['setMonth'];

    public function mount()
    {
        $service = new ShipmentsAnalytics();
        $this->data = $service->ShipmentMonthlyGraphDataSet();

        $this->arrivals = collect($this->data['Graphs'])->map(function ($arrivals) {
            return $arrivals['ArrivalTotal'] ?? 0;
        })->sum();

        $this->departures = collect($this->data['Graphs'])->map(function ($departures) {
            return $departures['DepartureTotal'] ?? 0;
        })->sum();

        $this->departureTEU = collect($this->data['Graphs'])->map(function ($teu) {
            return $teu['DeparturesTEUTotal'] ?? 0 ;
        })->sum();

        $this->arrivalTEU = collect($this->data['Graphs'])->map(function ($teu) {
            return $teu['ArrivalsTEUTotal'] ?? 0 ;
        })->sum();

        $this->teuCarrierCount = collect($this->data['Graphs']['CarrierTotal'][0])->map(function ($teu) {
            return $teu ?? 0 ;
        })->count();

        $this->teuCarrierJourneys = collect($this->data['Graphs']['CarrierTotal'][1])->map(function ($teu) {
            return $teu;
        })->sum();

        $this->totalCarrierTransit = array_combine($this->data['Graphs']['CarrierTotal'][0], $this->data['Graphs']['CarrierTotal'][1]);

    }

    public function GetTransitByMonth($month)
    {
        $departureCollection = array_combine($this->data['Graphs'][$month]['Departures']['Carriers'], $this->data['Graphs'][$month]['Departures']['Values']);

        return $departureCollection;
    }

    public function GetTEUByCarrierData($data)
    {
        if(isset($data['Departures']))
        {
            $departureCollection = array_combine($data['Departures']['TEUCarriers'], $data['Departures']['TEU']) ?? null;
        }

        if(isset($data['Arrivals']))
        {
            $arrivalCollection = array_combine($data['Arrivals']['TEUCarriers'], $data['Arrivals']['TEU']) ?? null;
        }

        $this->dispatchBrowserEvent('updateDepartureTEU', json_encode($departureCollection ?? ['none' => 0]));

        $this->dispatchBrowserEvent('updateArrivalTEU', json_encode($arrivalCollection ?? ['none' => 0]));

    }

    public function setMonth($month)
    {
        $this->currentMonth = $month;

        if(isset($month))
        {
            $this->arrivals = collect($this->data['Graphs'][$month]['Arrivals']['Values'])->sum() ?? 0;

            $this->arrivalTEU = collect($this->data['Graphs'][$month]['Arrivals']['TEU'])->sum() ?? 0;

            $this->departures = collect($this->data['Graphs'][$month]['Departures']['Values'])->sum() ?? 0;

            $this->departureTEU = collect($this->data['Graphs'][$month]['Departures']['TEU'])->sum() ?? 0;

            $this->totalCarrierTransit = $this->GetTransitByMonth($month);

            $this->GetTEUByCarrierData($this->data['Graphs'][$month]);
        }
    }

    public function ClearFilter()
    {
        $this->arrivals = collect($this->data['Graphs'])->map(function ($arrivals) {
            return $arrivals['ArrivalTotal'] ?? 0;
        })->sum();

        $this->departures = collect($this->data['Graphs'])->map(function ($departures) {
            return $departures['DepartureTotal'] ?? 0;
        })->sum();

        $this->departureTEU = collect($this->data['Graphs'])->map(function ($teu) {
            return $teu['DeparturesTEUTotal'] ?? 0 ;
        })->sum();

        $this->arrivalTEU = collect($this->data['Graphs'])->map(function ($teu) {
            return $teu['ArrivalsTEUTotal'] ?? 0 ;
        })->sum();

        $this->teuCarrierCount = collect($this->data['Graphs']['CarrierTotal'][0])->map(function ($teu) {
            return $teu ?? 0 ;
        })->count();

        $this->teuCarrierJourneys = collect($this->data['Graphs']['CarrierTotal'][1])->map(function ($teu) {
            return $teu;
        })->sum();

        $this->totalCarrierTransit = array_combine($this->data['Graphs']['CarrierTotal'][0], $this->data['Graphs']['CarrierTotal'][1]);

        $this->currentMonth = null;

        $this->emit('ClearFilter');
    }

    public function render()
    {
        return view('livewire.analytics.shipment.monthly-shipments-chart-component');
    }
}
