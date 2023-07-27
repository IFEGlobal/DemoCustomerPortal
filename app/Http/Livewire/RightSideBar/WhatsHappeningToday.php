<?php

namespace App\Http\Livewire\RightSideBar;

use App\Models\Container;
use App\Models\ContainerDelivery;
use App\Models\Document;
use App\Models\JobInvoicing;
use App\Models\Shipment;
use Illuminate\Support\Carbon;
use Livewire\Component;

class WhatsHappeningToday extends Component
{
    public function GoToShipments()
    {
        return redirect()->to('/shipments/shipments');
    }

    public function GoToContainers()
    {
        return redirect()->to('/shipments/containers');
    }

    public function GoToDeliveries()
    {
        return redirect()->to('/bookings/deliveries');
    }

    public function GoToInvoices()
    {
        return redirect()->to('/invoices');
    }

    public function OpenShipment($id)
    {
        return redirect()->to('/shipments/shipments/'.$id);
    }

    public function OpenDocument($id)
    {
        return redirect()->to('/documents/view-document/'.$id);
    }

    public function OpenDelivery($id)
    {
        return redirect()->to('/bookings/delivery/view-delivery/'.$id);
    }

    public function render()
    {

        $shipments = Shipment::where(function($arrival){
            $arrival->whereBetween('estimated_arrival', [now()->startOfWeek(), now()->endOfWeek()]);
        })->get();

        $containers = Container::whereHas('shipment', function ($limit){
            $limit->whereBetween('estimated_arrival', [now()->startOfWeek(), now()->endOfWeek()]);
        })->get();

        $deliveries = ContainerDelivery::whereBetween('arrival_estimated_delivery',[now()->startOfWeek(), now()->endOfWeek()])->get();

        $documents = Document::whereBetween('saved_date',[now()->startOfWeek(), now()->endOfWeek()])->get();

        return view('livewire.right-side-bar.whats-happening-today',[
            'Shipments' => $shipments,
            'Containers' => $containers,
            'Deliveries' => $deliveries,
            'Documents' => $documents
        ]);
    }
}
