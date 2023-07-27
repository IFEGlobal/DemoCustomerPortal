<?php

namespace App\Http\Livewire\Shipments;

use App\Exports\CardClickExport;
use App\Models\ContainerDelivery;
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
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Usernotnull\Toast\Concerns\WireToast;
use WireUi\Traits\Actions;

class ViewShipmentDeliveriesDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = ContainerDelivery::class;

    public ?string $shipmentId;

    public function mount(string $shipmentId): void {}

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Deliveries Found');
    }

    public function builder(): Builder
    {
        return ContainerDelivery::query()->whereHas('shipment', function ($limit){
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
            Column::make("Transport Booking Ref", "transportBooking.transport_booking_ref")
                ->searchable()
                ->eagerLoadRelations()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Shipment Ref", "shipment.shipment_ref")
                ->searchable()
                ->deselected()
                ->eagerLoadRelations()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Container #", "container.container_no")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Container type", "description")
                ->sortable()
                ->deselected()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Est Arrival", 'shipment.estimated_arrival')
                ->format(fn($value, $row, Column $column) => view('datatable.bluebadgecomponent')->withValue(Carbon::parse($value)?->format('d M y H:i')))
                ->eagerLoadRelations()
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Expected Delivery Date", "arrival_estimated_delivery")
                ->format(fn($value, $row, Column $column) => view('datatable.greenbadgecomponent')->withValue($row->arrival_estimated_delivery?->format('d M y H:i') ?? 'Awaiting Delivery Date'))
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('View')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('delivery', ['id' => $row->id])),
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
            $deliveries = ContainerDelivery::findMany($ids);

            if(count($deliveries))
            {
                toast()->success('We are sending the report to your browser','Downloading')->push();
                return Excel::download(new CardClickExport($this->GetDeliveryHeadersAndData($deliveries)), 'LiveDeliveryTableExport.xlsx');
            }
            else
            {
                toast()->warning('No records where selected from the table','Warning')->push();
            }

            $this->clearSelected();
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
            $deliveries = ContainerDelivery::findMany($ids);

            foreach($deliveries as $delivery)
            {
                $model = get_class($delivery);

                $addToFavorites = new AddToFavorites($model, $delivery->id, Auth::user()->id, $delivery->container_id);

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
            $deliveries = ContainerDelivery::findMany($ids);

            foreach($deliveries as $delivery)
            {
                $model = get_class($delivery);

                $addToPriority = new AddToPriority($model, $delivery->id, Auth::user()->id, $delivery->container_id);

                $response = $addToPriority->CheckExistance();

                toast()->info($response['message'],$response['title'])->push();
            }

            $this->clearSelected();
        }
    }

    public function GetDeliveryHeadersAndData($query)
    {
        $headers = [
            'Shipment Reference','PO Number','House Reference','Container Number','Transport Mode','Container Type',
            'Description','Vessel/Flight Name','Estimated Arrival','Cleared Date',
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
            $exportCollection[$key]['Vessel/Flight Name'] = $data->shipment->vessel ?? null;
            $exportCollection[$key]['Estimated_arrival'] = $data->shipment->estimated_arrival ?? null;
            $exportCollection[$key]['Cleared Date'] = $data->shipment->cleared_date ?? null;
            $exportCollection[$key]['Delivery Date'] = $data->arrival_estimated_delivery ?? null;
        }

        return [$headers,$exportCollection];
    }
}
