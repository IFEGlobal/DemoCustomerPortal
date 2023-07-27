<?php

namespace App\Http\Livewire\Analytics;

use App\Exports\CardClickExport;
use App\Services\UserService\AddToFavorites;
use App\Services\UserService\AddToPriority;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Shipment;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Usernotnull\Toast\Concerns\WireToast;

class ShipmentAnalyticsDatatable extends DataTableComponent
{
    use WireToast;

    public function builder(): builder
    {
        return Shipment::query()
            ->with('containers')
            ->whereYear('estimated_departure', '>', now()->subYears(2));
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Shipments');

        $this->setDefaultSort('estimated_arrival', 'asc');

        $this->setFilterLayout('slide-down');

        $this->setTrAttributes(function($row, $index) {
            return [
                'wire:click' => 'updateFunction('.$row->id.')',
            ];
        });
    }

    public array $bulkActions = [
        'exportSelected' => '🖨️ Export',

        'addToFavorites' => '⭐ Favorite',

        'addToPriorities' => '⚡ Priority',
    ];

    public function columns(): array
    {
        return [
            Column::make("Data Identifier", 'id')
                ->searchable()
                ->deselected()
                ->sortable(),
            Column::make("PO Number", 'PO_number')
                ->searchable()
                ->sortable(),
            Column::make("Reference", 'shipment_ref')
                ->searchable()
                ->deselected()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Mode", 'transport_mode')
                ->searchable()
                ->deselected()
                ->sortable()
                ->collapseOnMobile(),
            Column::make('Vessel', 'vessel')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Port of Loading", 'loading_port_name')
                ->searchable()
                ->sortable()
                ->deselected()
                ->collapseOnMobile(),
            Column::make("Port of Discharge", 'disc_port_name')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Departure", 'estimated_departure')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->estimated_departure ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Arrival", 'estimated_arrival')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->estimated_arrival ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Port Arrival", 'port_arrival_date')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->port_arrival_date ?? $row->estimated_arrival ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('View')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('shipment', ['id' => $row->id])),
                ])
        ];
    }

    public function exportSelected()
    {
        $ids = $this->getSelected();

        if (empty($ids))
        {
            toast()->warning('No records where selected from the table','Warning')->push();
        }
        else
        {
            $shipments = Shipment::findMany($ids);

            if(count($shipments))
            {
                toast()->success('We are sending the report to your browser','Downloading')->push();
                return Excel::download(new CardClickExport($this->GetShipmentHeadersAndData($shipments)), 'AnalyticsShipmentTableExport.xlsx');
            }
            else
            {
                toast()->warning('No records where selected from the table','Warning')->push();
            }
        }
    }

    public function addToFavorites()
    {
        $ids = $this->getSelected();

        if (empty($ids)) {
            toast()->warning('No records where selected from the table','Warning')->push();
        } else {
            $shipments = Shipment::findMany($ids);

            foreach ($shipments as $shipment)
            {
                $model = get_class($shipment);

                $addToFavorites = new AddToFavorites($model, $shipment->id, Auth::user()->id, $shipment->shipment_ref);

                $response = $addToFavorites->CheckExistance();

                toast()->info($response['message'],$response['title'])->push();
            }
        }

        $this->clearSelected();
    }

    public function addToPriorities()
    {
        $ids = $this->getSelected();

        if (empty($ids)) {
            toast()->warning('No records where selected from the table','Warning')->push();
        } else {
            $shipments = Shipment::findMany($ids);

            foreach ($shipments as $shipment) {
                $model = get_class($shipment);

                $addToPriority = new AddToPriority($model, $shipment->id, Auth::user()->id, $shipment->shipment_ref);

                $response = $addToPriority->CheckExistance();

                toast()->info($response['message'],$response['title'])->push();
            }
        }

        $this->clearSelected();
    }

    public function GetShipmentHeadersAndData($query)
    {
        $headers = [
            'Shipment Reference','PO Number','House Reference','Transport Mode','Consignee',
            'Consignor','Loading Port','Discharge Port','Vessel/Flight Name','Voyage Reference','Estimated Departure',
            'Estimated Arrival', 'Port Arrival','Cleared Date', 'Estimated Delivery Date',
            'Consignee Collection Address','Number Of Containers'
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
            $exportCollection[$key]['Voyage Reference'] = $data->voyage ?? null;
            $exportCollection[$key]['Estimated_departure'] = $data->estimated_departure ?? null;
            $exportCollection[$key]['Estimated_arrival'] = $data->estimated_arrival ?? null;
            $exportCollection[$key]['Port Arrival'] = $data->port_arrival_date ?? $data->estimated_arrival ?? null;
            $exportCollection[$key]['Cleared Date'] = $data->cleared_date ?? null;
            $exportCollection[$key]['Estimated Delivery Date'] = $data->estimated_delivery ?? null;
            $exportCollection[$key]['Consignee Collection Address'] = $data->consignee_pick_up_address ?? null;
            $exportCollection[$key]['Number Of Containers'] = $data->containers()->count() ?? 0;
        }

        return [$headers,$exportCollection];
    }

    public function updateFunction($id)
    {
        $this->emit('clickedShipment', $id);
    }
}
