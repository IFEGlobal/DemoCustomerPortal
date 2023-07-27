<?php

namespace App\Http\Livewire\RightSideBar;

use App\Models\Document;
use App\Models\JobCosting;
use App\Models\JobInvoicing;
use App\Services\DataService\GetOrganisationData;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrganisationDetailsComponent extends Component
{
    public function render()
    {
        return view('livewire.right-side-bar.organisation-details-component');
    }
}
