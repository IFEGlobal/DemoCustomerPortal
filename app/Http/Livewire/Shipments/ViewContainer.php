<?php

namespace App\Http\Livewire\Shipments;

use App\DataResources\Co2Resource;
use App\DataResources\MilestonesResource;
use App\DataResources\PolylineResource;
use App\DataResources\VesselPostionResource;
use App\Jobs\RequestCo2Data;
use App\Models\Container;
use App\Services\DataService\EstimateVesselPosition;
use Livewire\Component;

class ViewContainer extends Component
{
    public $record;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($id)
    {
        $this->record = Container::findOrFail($id);
    }

    public function goTo(string $url)
    {
        return $this->redirect($url);
    }

    public function render()
    {

        $data = $this->record->milestones;

        $route = $this->record->polyline;

        $getPosition = (new EstimateVesselPosition($this->record->polyline, $this->record->shipment->estimated_arrival, $this->record->shipment->estimated_departure))->AssessDays();

        $co2Data = $this->record->shipment->co2_actual_data ?? $this->record->shipment->co2_estimate_data ?? null;

        if(is_string($co2Data)) {
            $co2 = json_decode($co2Data, true) ?? null;
        }else{
            $co2 = $co2Data ?? null;
        }

        if(isset($data['Milestones']))
        {
            foreach($data['Milestones'] as $positions)
            {
                $locations[] = [$positions['LocationName'], $positions['Latitude'], $positions['Longitude']];
            }
        }

        return view('livewire.shipments.view-container',[
            'tracking' => collect($data)->sortBy('EventDateTime')->all(),
            'locations' => $locations ?? null,
            'polyline' => $route ?? null,
            'vessel' => $position ?? null,
            'position' => $getPosition ?? null,
            'Co2Data' => $co2
        ]);
    }
}
