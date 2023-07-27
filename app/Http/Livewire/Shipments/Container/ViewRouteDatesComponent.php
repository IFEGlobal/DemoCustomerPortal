<?php

namespace App\Http\Livewire\Shipments\Container;

use App\DataResources\RouteHistoryResource;
use App\Models\Container;
use App\Services\DataService\RequestRouteHistory;
use Livewire\Component;

class ViewRouteDatesComponent extends Component
{
    public $containerId;

    public function mount($containerId)
    {
        $this->record = Container::find($containerId);
    }

    public function render()
    {
        $service = new RequestRouteHistory($this->record);
        $history = $service->RetrieveHistory();

        return view('livewire.shipments.container.view-route-dates-component',[
            'scheduled' => $history['scheduled'] ?? null,
            'planned' => $history['planned'] ?? null,
            'actual' => $history['actual'] ?? null,
        ]);
    }
}
