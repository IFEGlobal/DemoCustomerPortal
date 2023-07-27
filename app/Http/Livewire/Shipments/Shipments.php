<?php

namespace App\Http\Livewire\Shipments;

use App\Models\Shipment;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Shipments extends Component
{
    protected $listeners = ['render' => 'render'];

    public function goTo(string $url): void
    {
        redirect()->to($url);
    }

    public function render()
    {
        $query = Shipment::query();

        $TotalShipments = $query->count();

        $TotalActiveShipments = $query->where('estimated_arrival', '>', now())
            ->where('estimated_departure', '<', now())
            ->count();

        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $ShipmentsArrivalsThisWeek = Shipment::where(function ($query) use ($weekStart, $weekEnd) {
            $query->whereBetween('port_arrival_date', [$weekStart, $weekEnd])
                ->orWhereBetween('estimated_arrival', [$weekStart, $weekEnd]);
        })
            ->count();

        $ShipmentsDepartingThisWeek = Shipment::whereBetween('estimated_departure', [$weekStart, $weekEnd])
            ->count();

        $TotalClearances = Shipment::whereBetween('estimated_arrival', [$weekStart, $weekEnd])
            ->whereNotNull('cleared_date')
            ->count();

        $Sea = $query->where('transport_mode', 'SEA')->count();
        $ActiveSea = $query->where('transport_mode', 'SEA')
            ->where('estimated_arrival', '>', Carbon::now())
            ->count();

        $Air = $query->where('transport_mode', 'AIR')->count();
        $ActiveAir = $query->where('transport_mode', 'AIR')
            ->where('estimated_arrival', '>', Carbon::now())
            ->count();

        $Rail = $query->where('transport_mode', 'RAI')->count();
        $ActiveRail = $query->where('transport_mode', 'RAI')
            ->where('estimated_arrival', '>', Carbon::now())
            ->count();

        $Road = $query->where('transport_mode', 'ROA')->count();
        $ActiveRoad = $query->where('transport_mode', 'ROA')
            ->where('estimated_arrival', '>', Carbon::now())
            ->count();

        return view('livewire..shipments.shipments', [
            'TotalShipments' => $TotalShipments,
            'TotalActiveShipments' => $TotalActiveShipments,
            'TotalClearances' => $TotalClearances,
            'ArrivalsThisWeek' => $ShipmentsArrivalsThisWeek,
            'DepartingThisWeek' =>$ShipmentsDepartingThisWeek,
            'SeaFreight' => [$Sea, $ActiveSea],
            'AirFreight' => [$Air, $ActiveAir],
            'RailFreight' => [$Rail, $ActiveRail],
            'RoaFreight' => [$Road, $ActiveRoad],
        ]);
    }
}
