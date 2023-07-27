<?php

namespace App\Http\Livewire\Analytics;

use App\Models\Shipment;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ShipmentAnalyticsTable extends Component
{
    use WithPagination;

    public $month;

    public $year;

    public $clear = false;

    public $route = null;

    protected $listeners = ['setMonth', 'ClearFilter', 'SetRoute'];

    public function setMonth($month)
    {
        $this->month = Carbon::parse($month)->format('m');

        $this->year = '20'.substr($month, -2);

        $this->route = null;
    }

    public function SetRoute($route)
    {
        $this->route = $route;
    }

    public function ClearFilter()
    {
        $this->clear = true;

        $this->route = null;
    }

    public function goToShipment($id)
    {
        return redirect()->to('/shipments/shipments/'.$id);
    }

    public function render()
    {
        if($this->clear === false)
        {
            $shipments = Shipment::query()->where(function($month) {
                $month->whereMonth('estimated_departure', $this->month)->orWhereMonth('estimated_arrival', $this->month);
            })->where(function ($year) {
                $year->whereYear('estimated_departure', $this->year)->orWhereYear('estimated_arrival', $this->year);
            })->whereYear('estimated_departure', '>', now()->subYears(2))->orderBy('estimated_departure');
        }

        if($this->route !== null)
        {
            $shipments = Shipment::query()->where('loading_port_name', $this->route[0])->where('disc_port_name', $this->route[1]);
        }

        if($this->clear === true && $this->route == null)
        {
            $shipments = Shipment::where('shipment_ref', null);

            $this->clear = false;
        }

        return view('livewire.analytics.shipment-analytics-table',[
            'shipments' => $shipments->paginate(10) ?? null
        ]);
    }
}
