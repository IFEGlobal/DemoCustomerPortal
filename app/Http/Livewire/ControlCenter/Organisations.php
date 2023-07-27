<?php

namespace App\Http\Livewire\ControlCenter;

use App\Models\JobCosting;
use App\Services\DataService\GetOrganisationData;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Organisations extends Component
{
    public function render()
    {
        $user = Auth::user();

        foreach($user->access as $key => $registered)
        {
            $requestOrganisationData = new GetOrganisationData($registered);

            $organisations[$key] = $requestOrganisationData->GetOrganisation();

            $getInvoices = JobCosting::whereHas('shipment', function ($limit) use ($registered)
            {
                $limit->where('shipments.consignee_code', '=' ,$registered->client_code)
                    ->orWhere('shipments.consignor_code', '=' ,$registered->client_code);
            })->get();

            $invoices = $getInvoices->map(function($outstanding){
                return  $outstanding->latestInvoice->sell_outstanding_amount ?? 0.00;
            })->sum();

            $organisations[$key]['outstandingBalance'] = $invoices ?? 0.00;

            if(($organisations[$key]['outstandingBalance'] !== 0.00) && ($organisations[$key]['ar_global_credit_limit'] !== 0.00))
            {
                $organisations[$key]['width'] = floatval(($organisations[$key]['outstandingBalance'] / $organisations[$key]['ar_global_credit_limit']) * 100);
            }
            else
            {
                $organisations[$key]['width'] = 0;
            }

        }

        dd($organisations);

        return view('livewire..control-center.organisations', [
            'organisations' => $organisations,
        ]);
    }
}
