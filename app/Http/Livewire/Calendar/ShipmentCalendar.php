<?php

namespace App\Http\Livewire\Calendar;

use App\Exports\CardClickExport;
use App\Models\ContainerDelivery;
use App\Models\Shipment;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ShipmentCalendar extends Component
{

    public $shipmentQuery;

    public $deliveryQuery;

    public $Arrivals;

    public $Departures;

    public $Clearances;

    public $Deliveries;

    public $ArrivalsThisMonth;

    public $DeparturesThisMonth;

    public $ClearancesThisMonth;

    public $DeliveriesThisMonth;


    public function goToLiveDashboard()
    {
        return redirect()->to('/dashboard');
    }

    public function goToFavorites()
    {
        return redirect()->to('/space/favorites');
    }

    public function goToPriorities()
    {
        return redirect()->to('/space/priorities');
    }

    public function mount()
    {
        $this->shipmentQuery = Shipment::get();

        $this->deliveryQuery = ContainerDelivery::where('arrival_estimated_delivery', '>', now()->subDays(7))->get();
    }

    public function ShipmentsThisWeek()
    {
        return $this->shipmentQuery->whereBetween('estimated_arrival', [Carbon::now()->startOfWeek(0), Carbon::now()->endOfWeek(6)]);
    }

    public function ShipmentsThisMonth()
    {
        return $this->shipmentQuery->whereBetween('estimated_arrival', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }

    public function DeparturesThisWeek()
    {
        return $this->shipmentQuery->whereBetween('estimated_departure', [Carbon::now()->startOfWeek(0), Carbon::now()->endOfWeek(6)]);
    }

    public function DeparturesThisMonth()
    {
        return $this->shipmentQuery->whereBetween('estimated_departure', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }

    public function ClearancesThisWeek()
    {
        return $this->shipmentQuery->whereBetween('estimated_arrival', [Carbon::now()->startOfWeek(0), Carbon::now()->endOfWeek(6)])->where('cleared_date', '!=', null);
    }

    public function ClearancesThisMonth()
    {
        return $this->shipmentQuery->whereBetween('estimated_arrival', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('cleared_date', '!=', null);
    }

    public function DeliveriesThisWeek()
    {
        return $this->deliveryQuery->whereBetween('arrival_estimated_delivery', [Carbon::now()->startOfWeek(0), Carbon::now()->endOfWeek(6)]);
    }

    public function DeliveriesThisMonth()
    {
        return $this->deliveryQuery->whereBetween('arrival_estimated_delivery', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }

    public function ExportCard($collection,$headers,$title)
    {
        if($this->$collection()->count() > 0)
        {
            if($headers == 'Shipment')
            {
                return Excel::download(new CardClickExport($this->GetShipmentHeadersAndData($this->$collection())), $title.'.xlsx');
            }

            if($headers == 'Deliveries')
            {
                return Excel::download(new CardClickExport($this->GetDeliveryHeadersAndData($this->$collection())), $title.'.xlsx');
            }
        }

        session()->flash('message', 'Opps, you clicked on a card with no records so there is nothing to download here.');
    }


    public function GetShipmentHeadersAndData($query)
    {
        $headers = [
            'Shipment Reference','PO Number','House Reference','Transport Mode','Consignee',
            'Consignor','Loading Port','Discharge Port','Vessel/Flight Name','Estimated_departure',
            'Estimated_arrival','cleared_date','Number Of Containers'
        ];

        foreach($query as $key => $data)
        {
            $exportCollection[$key]['Shipment Reference'] = $data->shipment_ref ?? null;
            $exportCollection[$key]['PO Number'] = $data->PO_number ?? null;
            $exportCollection[$key]['House Reference'] = $data->house_ref ?? null;
            $exportCollection[$key]['Transport Mode'] = $data->transport_mode ?? null;
            $exportCollection[$key]['Consignee'] = $data->consignee_name ?? null;
            $exportCollection[$key]['Consignor'] = $data->consignor_name ?? null;
            $exportCollection[$key]['Loading Port'] = $data->loading_port_name ?? null;
            $exportCollection[$key]['Discharge Port'] = $data->disc_port_name ?? null;
            $exportCollection[$key]['Vessel/Flight Name'] = $data->vessel ?? null;
            $exportCollection[$key]['Estimated_departure'] = $data->estimated_departure ?? null;
            $exportCollection[$key]['Estimated_arrival'] = $data->estimated_arrival ?? null;
            $exportCollection[$key]['Cleared Date'] = $data->cleared_date ?? null;
            $exportCollection[$key]['Number Of Containers'] = $data->containers()->count() ?? 0;
        }

        return [$headers,$exportCollection];
    }

    public function GetDeliveryHeadersAndData($query)
    {
        $headers = [
            'Shipment Reference','PO Number','House Reference','Container Number','Transport Mode','Container Type',
            'Description','Goods Weight','Gross Weight','Units','Vessel/Flight Name','Estimated Arrival','Cleared Date',
            'Delivery Date',
        ];

        foreach($query as $key => $data)
        {
            $exportCollection[$key]['Shipment Reference'] = $data->shipment->shipment_ref ?? null;
            $exportCollection[$key]['PO Number'] = $data->shipment->PO_number ?? null;
            $exportCollection[$key]['House Reference'] = $data->shipment->house_ref ?? null;
            $exportCollection[$key]['Container Number'] = $data->container->container_no ?? null;
            $exportCollection[$key]['Transport Mode'] = $data->shipment->transport_mode ?? null;
            $exportCollection[$key]['Container Type'] = $data->container_type ?? null;
            $exportCollection[$key]['Description'] = $data->description ?? null;
            $exportCollection[$key]['Goods Weight'] = $data->goods_weight ?? null;
            $exportCollection[$key]['Gross Weight'] = $data->gross_weight ?? null;
            $exportCollection[$key]['Units'] = $data->weight_unit ?? null;
            $exportCollection[$key]['Vessel/Flight Name'] = $data->shipment->vessel ?? null;
            $exportCollection[$key]['Estimated_arrival'] = $data->shipment->estimated_arrival ?? null;
            $exportCollection[$key]['Cleared Date'] = $data->shipment->cleared_date ?? null;
            $exportCollection[$key]['Delivery Date'] = $data->arrival_estimated_delivery ?? null;
        }

        return [$headers,$exportCollection];
    }


    public function render()
    {
        $this->Arrivals = $this->ShipmentsThisWeek()->count();

        $this->ArrivalsThisMonth = $this->ShipmentsThisMonth()->count();

        $this->Departures = $this->DeparturesThisWeek()->count();

        $this->DeparturesThisMonth = $this->DeparturesThisMonth()->count();

        $this->Clearances = $this->ClearancesThisWeek()->count();

        $this->ClearancesThisMonth = $this->ClearancesThisMonth()->count();

        $this->Deliveries = $this->DeliveriesThisWeek()->count();

        $this->DeliveriesThisMonth = $this->DeliveriesThisMonth()->count();

        return view('livewire..calendar.shipment-calendar');
    }
}
