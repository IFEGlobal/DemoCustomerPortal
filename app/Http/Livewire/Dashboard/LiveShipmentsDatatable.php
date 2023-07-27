<?php

namespace App\Http\Livewire\Dashboard;

use App\Exports\CardClickExport;
use App\Services\UserService\AddToFavorites;
use App\Services\UserService\AddToPriority;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Shipment;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Usernotnull\Toast\Concerns\WireToast;


class LiveShipmentsDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = Shipment::class;

    public string $tableName = 'Live Shipments';

    public function builder(): Builder
    {
        return Shipment::query()->whereDate('port_arrival_date', '>', now())->orWhere(function($eta){
            $eta->where('estimated_arrival', '>', now())
                ->orWhere(function($delivery){
                    $delivery->whereHas('containerDeliveries', function ($limit) {
                        $limit->where('arrival_estimated_delivery', '>', now());
                    })->orWhere('actual_delivery', '<', now());
                });
            })->where('actual_delivery', null);
    }

    public array $bulkActions = [
        'exportSelected' => '🖨️ Export',

        'addToFavorites' => '⭐ Favorite',

        'addToPriorities' => '⚡ Priority',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Live Shipments');

        $this->setDefaultSort('estimated_arrival', 'asc');

        $this->setFilterLayout('slide-down');
    }

    public function columns(): array
    {
        return [
            Column::make("Data Identifier", 'id')
                ->searchable()
                ->deselected()
                ->sortable(),
            Column::make("PO Number", 'PO_number')
                ->format(fn($value, $row, Column $column) => view('datatable.PONumberBadgeComponent')->withValue($value ?? null))
                ->searchable()
                ->sortable(),
            Column::make("Reference", 'shipment_ref')
                ->searchable()
                ->sortable(),
            Column::make("Supplier/Consignor", 'consignor_name')
                ->collapseOnMobile()
                ->searchable()
                ->sortable(),
            Column::make("Consignee", 'consignee_name')
                ->collapseOnMobile()
                ->searchable()
                ->sortable(),
            Column::make('Vessel', 'vessel')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Port of Loading",'loading_port_name')
                ->searchable()
                ->sortable()
                ->deselected()
                ->collapseOnMobile(),
            Column::make("Port of Discharge",'disc_port_name')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Departure",'estimated_departure')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->estimated_departure ?? null))
                ->deselected()
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Arrival",'estimated_arrival')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->estimated_arrival ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Transit Days",'transit_days')
                ->format(fn($value, $row, Column $column) => view('datatable.routeDays')->withValue(($row->transit_days)))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Route AVG",'route_avg')
                ->format(fn($value, $row, Column $column) => view('datatable.routeDifference')->withValue(($row->transit_days - $row->route_avg)))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Port Arrival",'port_arrival_date')
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

    public function filters(): array
    {
        return [
            SelectFilter::make('Last Updated')
                ->setFilterPillTitle('Last Updated')
                ->options([
                    '' => 'All',
                    'since last login' => 'Since Last Login',
                    'last 24 hours' => 'Last 24 Hours',
                    'this week' => 'This Week'
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === 'since last login') {
                        $builder->where('shipments.updated_at', '>',  Carbon::parse(Auth::user()->last_login_at));
                    } elseif ($value === 'last 24 hours') {
                        $builder->where('shipments.updated_at', '>', now()->subHours(24));
                    }elseif ($value === 'this week') {
                        $builder->whereBetween('shipments.updated_at', [now()->startOfWeek(), carbon::now()]);
                    }
                }),
            SelectFilter::make('Departing')
                ->setFilterPillTitle('Due To Depart')
                ->setFilterPillValues([
                    0 => 'Today',
                    1 => 'This Week',
                    2 => 'This Month'
                ])
                ->options([
                    '' => 'All',
                    0 => 'Today',
                    1 => 'This Week',
                    2 => 'This Month'
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->whereDate('estimated_departure', '=', today());
                    } elseif ($value == 1) {
                        $builder->whereBetween('estimated_departure',[ now()->startOfWeek(), now()->endOfWeek()]);
                    }elseif ($value == 2) {
                        $builder->whereBetween('estimated_departure', [now()->startOfMonth(), now()->endOfMonth()]);
                    }
                }),
            SelectFilter::make('Arriving')
                ->setFilterPillTitle('Due To Arrive')
                ->setFilterPillValues([
                    0 => 'Today',
                    1 => 'This Week',
                    2 => 'This Month'
                ])
                ->options([
                    '' => 'All',
                    0 => 'Today',
                    1 => 'This Week',
                    2 => 'This Month'
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->whereDate('port_arrival_date', '=', today())->orWhere('estimated_arrival', '=', today());
                    } elseif ($value == 1) {
                        $builder->whereBetween('port_arrival_date',[ now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_arrival',[ now()->startOfWeek(), now()->endOfWeek()]);
                    }elseif ($value == 2) {
                        $builder->whereBetween('port_arrival_date',[ now()->startOfMonth(), now()->endOfMonth()])->orWhereBetween('estimated_arrival', [now()->startOfMonth(), now()->endOfMonth()]);
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
                        $builder->whereBetween('port_arrival_date', [ now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_arrival', [ now()->startOfWeek(), now()->endOfWeek()]);
                    } elseif ($value == 1) {
                        $builder->whereBetween('estimated_departure',[ now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_departure',[ now()->startOfWeek(), now()->endOfWeek()]);
                    }elseif ($value == 2) {
                        $builder->where('estimated_arrival', '>', now())->where('estimated_departure', '<', now());
                    }
                }),
            SelectFilter::make('Container')
                ->setFilterPillTitle('Container Load')
                ->setFilterPillValues([
                    0 => 'Part Container Load',
                    1 => 'Full Container Load',
                ])
                ->options([
                    '' => 'All',
                    0 => 'Part Container Load',
                    1 => 'Full Container Load',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->whereHas('containers', function ($lcl){
                            $lcl->where('container_mode', '=', 'LCL');
                        });
                    } elseif ($value === 1) {
                        $builder->whereHas('containers', function ($fcl){
                            $fcl->where('container_mode', '=', 'FCL');
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
                        $builder->where('transport_mode', '=', 'SEA');
                    } elseif ($value == 1) {
                        $builder->where('transport_mode', '=', 'AIR');
                    } elseif ($value == 2) {
                        $builder->where('transport_mode', '=', 'ROA');
                    }elseif ($value == 3) {
                        $builder->where('transport_mode', '=', 'RAI');
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
            $shipments = Shipment::findMany($ids);

            if(count($shipments))
            {
                toast()->success('We are sending the report to your browser','Downloading')->push();
                return Excel::download(new CardClickExport($this->GetShipmentHeadersAndData($shipments)), 'LiveShipmentTableExport.xlsx');
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
}
