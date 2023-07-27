<?php

namespace App\Http\Livewire\Shipments;

use App\DataResources\CourierURLDataResource;
use App\Http\Controllers\StreamFileController;
use App\Models\Shipment;
use Livewire\Component;

class ViewShipment extends Component
{

    public $record;

    public $courierTracking = null;

    public function goTo(string $url): void
    {
        redirect()->to($url);
    }

    public function mount($id)
    {
        $this->record = Shipment::find($id);
        $this->courierTracking = CourierURLDataResource::findCourier($this->record->courier, $this->record->tracking_ref);
    }

    public function render()
    {
        return view('livewire..shipments.view-shipment');
    }
}
