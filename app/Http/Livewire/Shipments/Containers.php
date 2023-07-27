<?php

namespace App\Http\Livewire\Shipments;


use App\Models\Container;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Containers extends Component
{
    public function goToLiveDashboard()
    {
        return redirect()->to('/dashboard');
    }

    public function goToCalendar()
    {
        return redirect()->to('/calendar');
    }

    public function goToPriorities()
    {
        return redirect()->to('/space/priorities');
    }

    public function goToShipments()
    {
        return redirect()->to('/shipments/shipments');
    }

    public function goToDeliveries()
    {
        return redirect()->to('/bookings/deliveries');
    }

    public function render()
    {
        $query = Container::with('shipment')->get();

        $TotalContainers = $query->count();

        $ContainersDepartingThisWeek = $query->whereBetween('shipment.estimated_departure',[now()->startOfWeek(), now()->endOfWeek()])->count();

        $ContainersArrivalsThisWeek = $query->whereBetween('shipment.estimated_arrival',[now()->startOfWeek(), now()->endOfWeek()])->count();

        $TotalActiveContainers = $query->where('shipment.estimated_arrival', '>', Carbon::now())->where('shipment.estimated_departure', '<', now())->count();

        $DeliveriesThisWeek = $query->where('containerDelivery.arrival_estimated_delivery', '!=', null)->whereBetween('containerDelivery.arrival_estimated_delivery', [now()->startOfWeek(0), now()->endOfWeek(6)])->count();

        $FCLContainers = $query->where('container_mode', '=', 'FCL')->count();

        $ActiveFCLContainers = $query->where('container_mode', '=', 'FCL')->where('shipment.estimated_arrival', '>', Carbon::now())->count();

        $LCLContainers = $query->where('container_mode', '=', 'LCL')->count();

        $ActiveLCLContainers = $query->where('container_mode', '=', 'LCL')->where('shipment.estimated_arrival', '>', Carbon::now())->count();


        return view('livewire..shipments.containers', [
            'TotalContainers' => $TotalContainers,
            'TotalActiveContainers' => $TotalActiveContainers,
            'ArrivalsThisWeek' => $ContainersArrivalsThisWeek,
            'DepartingThisWeek' => $ContainersDepartingThisWeek,
            'DeliveriesThisWeek' => $DeliveriesThisWeek,
            'FCLContainers' => $FCLContainers,
            'ActiveFCLContainers' => $ActiveFCLContainers,
            'LCLContainers' => $LCLContainers,
            'ActiveLCLContainers' => $ActiveLCLContainers,
        ]);
    }
}
