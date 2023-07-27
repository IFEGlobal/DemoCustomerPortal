<?php

namespace App\Http\Livewire\Bookings\Delivery;

use App\Models\ContainerDelivery;
use Livewire\Component;

class ViewDelivery extends Component
{
    public $record;

    public function mount($id)
    {
        $this->record = ContainerDelivery::find($id);
    }

    public function render()
    {
        return view('livewire.bookings.delivery.view-delivery');
    }
}
