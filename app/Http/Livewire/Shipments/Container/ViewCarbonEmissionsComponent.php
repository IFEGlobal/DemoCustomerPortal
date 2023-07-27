<?php

namespace App\Http\Livewire\Shipments\Container;

use App\DataResources\Co2Resource;
use App\Services\DataService\ApportionCo2Data;
use Livewire\Component;

class ViewCarbonEmissionsComponent extends Component
{

    public $Co2Data;

    public $apportionedData;

    public function mount($record, $Co2Data)
    {
        $this->record = $record;

        if(is_string($Co2Data)) {
            $this->Co2Data = json_decode($Co2Data,true);
        } else {
            $this->Co2Data = $Co2Data;
        }

        $service =  new ApportionCo2Data($record,$this->Co2Data);

        $this->apportionedData = $service->GetTotalCarbonEmissions();
    }

    public function render()
    {
        return view('livewire.shipments.container.view-carbon-emissions-component');
    }
}
