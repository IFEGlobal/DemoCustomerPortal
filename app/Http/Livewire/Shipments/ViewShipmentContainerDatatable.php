<?php

namespace App\Http\Livewire\Shipments;

use App\Exports\CardClickExport;
use App\Models\Shipment;
use App\Services\UserService\AddToFavorites;
use App\Services\UserService\AddToPriority;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Container;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Usernotnull\Toast\Concerns\WireToast;
use WireUi\Traits\Actions;

class ViewShipmentContainerDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = Container::class;

    public ?string $shipmentId;

    public function mount(string $shipmentId): void {}

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Containers Found');
    }

    public function builder(): Builder
    {
        return Container::query()->whereHas('shipment', function ($limit){
            $limit->where('id', $this->shipmentId);
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
            Column::make("Data Identifier", "id")
                ->searchable()
                ->deselected()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("PO Number", "shipment.PO_number")
                ->format(fn($value, $row, Column $column) => view('datatable.PONumberBadgeComponent')->withValue(Str::limit($value, 10) ?? null))
                ->searchable()
                ->eagerLoadRelations()
                ->sortable(),
            Column::make("Shipment Ref", "shipment.shipment_ref")
                ->searchable()
                ->deselected()
                ->eagerLoadRelations()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Container #", "container_no")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Container Load", "container_mode")
                ->sortable()
                ->deselected()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Container type", "container_type")
                ->sortable()
                ->deselected()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Port of Loading", 'shipment.loading_port_name')
                ->searchable()
                ->sortable()
                ->deselected()
                ->collapseOnMobile(),
            Column::make("Port of Discharge", 'shipment.disc_port_name')
                ->searchable()
                ->eagerLoadRelations()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Arrival", 'shipment.estimated_arrival')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($value))
                ->eagerLoadRelations()
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Container delivery", "container_delivery")
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->container_delivery ?? null))
                ->searchable()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Last Updated", "updated_at")
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->updated_at ?? null))
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Consignee", 'shipment.consignee_name')
                ->deselected()
                ->collapseOnMobile()
                ->searchable()
                ->sortable(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('View')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('container', ['id' => $row->id])),
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
            $containers = Container::findMany($ids);

            if(count($containers))
            {
                toast()->success('We are sending the report to your browser','Downloading')->push();
                return Excel::download(new CardClickExport($this->GetContainersHeadersAndData($containers)), 'LiveContainerTableExport.xlsx');
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

        if(empty($ids))
        {
            toast()->warning('No records where selected from the table','Warning')->push();
        }
        else
        {
            $containers = Container::findMany($ids);

            foreach($containers as $container)
            {
                $model = get_class($container);

                $addToFavorites = new AddToFavorites($model, $container->id, Auth::user()->id, $container->container_no);

                $response = $addToFavorites->CheckExistance();

                toast()->info($response['message'],$response['title'])->push();
            }

            $this->clearSelected();
        }
    }

    public function addToPriorities()
    {
        $ids = $this->getSelected();

        if(empty($ids))
        {
            toast()->warning('No records where selected from the table','Warning')->push();
        }
        else
        {
            $containers = Container::findMany($ids);

            foreach($containers as $container)
            {
                $model = get_class($container);

                $addToPriority = new AddToPriority($model, $container->id, Auth::user()->id, $container->container_no);

                $response = $addToPriority->CheckExistance();

                toast()->info($response['message'],$response['title'])->push();
            }

            $this->clearSelected();
        }
    }

    public function GetContainersHeadersAndData($query)
    {
        $headers = [
            'Container Number', 'Container Mode','Container Type','Shipment Reference','PO Number','House Reference','Transport Mode','Consignee',
            'Consignor','Loading Port','Discharge Port','Vessel/Flight Name','Voyage Reference','Estimated Departure',
            'Estimated Arrival', 'Port Arrival','Cleared Date', 'Estimated Delivery Date',
            'Consignee Collection Address', 'Container Delivery Date'
        ];

        foreach($query as $key => $data)
        {
            $exportCollection[$key]['Container Number'] = $data->container_no ?? null;
            $exportCollection[$key]['Container Mode'] = $data->container_mode ?? null;
            $exportCollection[$key]['Container Type'] = $data->container_type ?? null;
            $exportCollection[$key]['Shipment Reference'] = $data->shipment->shipment_ref ?? null;
            $exportCollection[$key]['PO Number'] = $data->shipment->PO_number ?? null;
            $exportCollection[$key]['House Reference'] = $data->shipment->house_ref ?? null;
            $exportCollection[$key]['Transport Mode'] = $data->shipment->transport_mode ?? null;
            $exportCollection[$key]['Consignee'] = $data->shipment->consignee_name ?? null;
            $exportCollection[$key]['Consignor'] = $data->shipment->consignor_name ?? null;
            $exportCollection[$key]['Loading Port'] = $data->shipment->loading_port_name ?? null;
            $exportCollection[$key]['Discharge Port'] = $data->shipment->disc_port_name ?? null;
            $exportCollection[$key]['Vessel/Flight Name'] = $data->shipment->vessel ?? null;
            $exportCollection[$key]['Voyage Reference'] = $data->shipment->voyage ?? null;
            $exportCollection[$key]['Estimated_departure'] = $data->shipment->estimated_departure ?? null;
            $exportCollection[$key]['Estimated_arrival'] = $data->shipment->estimated_arrival ?? null;
            $exportCollection[$key]['Port Arrival'] = $this->getPortArrivalDate($data);
            $exportCollection[$key]['Cleared Date'] = $data->shipment->cleared_date ?? null;
            $exportCollection[$key]['Estimated Delivery Date'] = $data->shipment->estimated_delivery ?? null;
            $exportCollection[$key]['Consignee Collection Address'] = $data->shipment->consignee_pick_up_address ?? null;
            $exportCollection[$key]['Container Delivery Date'] = $data->container_delivery ?? null;
        }

        return [$headers,$exportCollection];
    }

    public function getPortArrivalDate($data)
    {
        if($data->port_arrival_date == null)
        {
            return $data->shipment->estimated_arrival;
        }

        return $data->shipment->estimated_arrival ?? null;
    }
}
