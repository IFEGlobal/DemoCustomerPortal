<?php

namespace App\Http\Livewire\Bookings;

use App\Models\ContainerDelivery;
use Livewire\Component;

class Deliveries extends Component
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

    public function goToContainers()
    {
        return redirect()->to('/shipments/containers');
    }

    public function render()
    {
        $query = ContainerDelivery::get();

        $totalDeliveries = $query->count();

        $activeDeliveries = $query->where('arrival_estimated_delivery', '>', now())->count();

        $deliveriesThisWeek = $query->whereBetween('arrival_estimated_delivery', [now()->startOfWeek(), now()->endOfWeek()])->count();

        $updatedThisWeek = $query->whereBetween('updated_at', [ now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('livewire..bookings.deliveries', [
            'totalDeliveries' => $totalDeliveries,
            'activeDeliveries' => $activeDeliveries,
            'deliveriesThisWeek' => $deliveriesThisWeek,
            'updatedThisWeek' => $updatedThisWeek
        ]);
    }
}
