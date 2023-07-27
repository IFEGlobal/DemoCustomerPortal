<?php

namespace App\Http\Livewire\Dashboard;

use App\Exports\CardClickExport;
use App\Http\Livewire\Documents\Documents;
use App\Models\Container;
use App\Models\Document;
use App\Services\UserService\AddToFavorites;
use App\Services\UserService\AddToPriority;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ContainerDelivery;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Usernotnull\Toast\Concerns\WireToast;
use WireUi\Traits\Actions;

class LiveDeliveriesDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = ContainerDelivery::class;

    public function builder(): Builder
    {
        return ContainerDelivery::query()->where('arrival_estimated_delivery', '>', now())->whereHas('shipment');
    }

    public array $bulkActions = [
        'exportSelected' => '🖨️ Export',

        'addToFavorites' => '⭐ Favorite',

        'addToPriorities' => '⚡ Priority',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Expected Deliveries');

        $this->setDefaultSort('arrival_estimated_delivery', 'asc');

        $this->setFilterLayout('slide-down');
    }

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
            Column::make("Related To", "shipment.shipment_ref")
                ->searchable()
                ->eagerLoadRelations()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Supplier/Consignor", 'shipment.consignor_name')
                ->collapseOnMobile()
                ->searchable()
                ->sortable(),
            Column::make("Transport Booking Ref", "transportBooking.transport_booking_ref")
                ->searchable()
                ->eagerLoadRelations()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Container #", "container.container_no")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Container Type", "description")
                ->sortable()
                ->deselected()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Est Arrival", 'shipment.estimated_arrival')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($value ?? null))
                ->eagerLoadRelations()
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Expected Delivery Date", "arrival_estimated_delivery")
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->arrival_estimated_delivery ?? null))
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('View')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('delivery', ['id' => $row->id])),
                ])
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Updated')
                ->setFilterPillTitle('Last Updated')
                ->setFilterPillValues([
                    0 => 'Since Last Login',
                    1 => 'Last 24 Hours',
                    2 => 'This Week'
                ])
                ->options([
                    '' => 'All',
                    0 => 'Since Last Login',
                    1 => 'Last 24 Hours',
                    2 => 'This Week'
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->where('container_deliveries.updated_at', '>', Carbon::parse(Auth::user()->last_login_at));
                    } elseif ($value == 1) {
                        $builder->where('container_deliveries.updated_at', '>', now()->subHours(24));
                    }elseif ($value == 2) {
                        $builder->whereBetween('container_deliveries.updated_at', [now()->startOfWeek(), carbon::now()]);
                    }
                }),
            SelectFilter::make('Delivery')
                ->setFilterPillTitle('Due To Be Delivered')
                ->setFilterPillValues([
                    0 => 'Today',
                    1 => 'This Week',
                    2 => 'This Month',
                    3 => 'In The Future'
                ])
                ->options([
                    '' => 'All',
                    0 => 'Today',
                    1 => 'This Week',
                    2 => 'This Month',
                    3 => 'In The Future'
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->whereDate('arrival_estimated_delivery', '=', today());
                    } elseif ($value == 1) {
                        $builder->whereBetween('arrival_estimated_delivery',[ now()->startOfWeek(), now()->endOfWeek()]);
                    }elseif ($value == 2) {
                        $builder->whereBetween('arrival_estimated_delivery',[ now()->startOfMonth(), now()->endOfMonth()]);
                    }elseif ($value == 3) {
                        $builder->where('arrival_estimated_delivery', '>', now());
                    }
                }),
            SelectFilter::make('Transit')
                ->setFilterPillTitle('Transit Status')
                ->setFilterPillValues([
                    0 => 'Arrived Recently',
                    1 => 'Departed Recently',
                    2 => 'In Transit'
                ])
                ->options([
                    '' => 'All',
                    0 => 'Arrived Recently',
                    1 => 'Departed Recently',
                    2 => 'In Transit'
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->whereHas('shipment', function ($limit){
                            $limit->whereBetween('port_arrival_date', [ now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_arrival', [ now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    } elseif ($value == 1) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereBetween('port_arrival_date', [now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_departure', [now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    }elseif ($value == 2) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->where('estimated_arrival', '>', now())->where('estimated_departure', '<', now());
                        });
                    }
                }),
            SelectFilter::make('Transport')
                ->setFilterPillTitle('Transport Mode')
                ->setFilterPillValues([
                    0 => 'Sea Freight',
                    1 => 'Air Freight',
                    2 => 'Road Freight',
                    3 => 'Rail Freight',
                ])
                ->options([
                    '' => 'All',
                    0 => 'Sea Freight',
                    1 => 'Air Freight',
                    2 => 'Road Freight',
                    3 => 'Rail Freight',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->where('transport_mode', '=', 'SEA');
                        });
                    } elseif ($value == 1) {
                        $builder->whereHas('shipment', function ($limit){
                            $limit->where('transport_mode', '=', 'AIR');
                        });
                    } elseif ($value == 2) {
                        $builder->whereHas('shipment', function ($limit){
                            $limit->where('transport_mode', '=', 'ROA');
                        });
                    }elseif ($value == 3) {
                        $builder->whereHas('shipment', function ($limit){
                            $limit->where('transport_mode', '=', 'RAI');
                        });
                    }
                }),
            SelectFilter::make('Container Type')
                ->setFilterPillTitle('Container Type')
                ->setFilterPillValues([
                    0 => '20GP',
                    1 => '40GP',
                ])
                ->options([
                    '' => 'All',
                    0 => '20GP',
                    1 => '40GP',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->where('container_deliveries.container_type', '=', '20GP');
                    } elseif ($value == 1) {
                        $builder->where('container_deliveries.container_type', '=', '40GP');
                    }
                }),
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
