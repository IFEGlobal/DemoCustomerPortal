<?php

namespace App\Http\Livewire\MySpace;

use App\Exports\CardClickExport;
use App\Models\Container;
use App\Models\ContainerDelivery;
use App\Services\UserService\AddToPriority;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Favorite;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Usernotnull\Toast\Concerns\WireToast;
use WireUi\Traits\Actions;

class FavoriteContainersDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = Favorite::class;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Containers');

        $this->setFilterLayout('slide-down');
    }

    public function builder(): Builder
    {
        $favorites = Favorite::query()->where('user_id', auth()->user()->id)->where('favorable_type', 'App\Models\Container')->get()->pluck('favorable_reference')->toArray();

        return Container::whereIn('container_no', $favorites);
    }

    public array $bulkActions = [
        'exportSelected' => '🖨️ Export',

        'removeFromFavorites' => '🗑️ Remove',

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
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue(Carbon::parse($value)))
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
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('View')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('container', ['id' => $row->id])),
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
                        $builder->where('containers.updated_at', '>', Auth::user()->last_login_at);
                    } elseif ($value === 'last 24 hours') {
                        $builder->where('containers.updated_at', '>', Carbon::parse(Auth::user()->last_login_at)->subHours(24));
                    }elseif ($value === 'this week') {
                        $builder->whereBetween('containers.updated_at', [now()->startOfWeek(), carbon::now()]);
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
                        $builder->whereHas('shipment', function ($limit){
                            $limit->whereDate('estimated_departure', '=', today());
                        });
                    } elseif ($value == 1) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereBetween('estimated_departure', [now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    }elseif ($value == 2) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereBetween('estimated_departure', [now()->startOfMonth(), now()->endOfMonth()]);
                        });
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
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereDate('port_arrival_date', '=', today())->orWhere('estimated_arrival', '=', today());
                        });
                    } elseif ($value == 1) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereBetween('port_arrival_date', [now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_arrival', [now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    }elseif ($value == 2) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereBetween('port_arrival_date', [now()->startOfMonth(), now()->endOfMonth()])->orWhereBetween('estimated_arrival', [now()->startOfMonth(), now()->endOfMonth()]);
                        });
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
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereBetween('port_arrival_date', [now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_arrival', [now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    } elseif ($value == 1) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->whereBetween('estimated_departure', [now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_departure', [now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    }elseif ($value == 2) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->where('estimated_arrival', '>', now())->where('estimated_departure', '<', now());
                        });
                    }
                }),
            SelectFilter::make('Deliveries')
                ->setFilterPillTitle('Deliveries')
                ->setFilterPillValues([
                    0 => 'Today',
                    1 => 'This Week',
                    2 => 'This Month'
                ])
                ->options([
                    '' => 'All',
                    0 => 'Delivering Today',
                    1 => 'Delivering This Week',
                    2 => 'Delivering This Month'
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->whereHas('containerDelivery', function ($limit) {
                            $limit->whereDate('arrival_cartage_advised', today());
                        });
                    } elseif ($value == 1) {
                        $builder->whereHas('containerDelivery', function ($limit) {
                            $limit->whereBetween('arrival_cartage_advised', [now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    }elseif ($value == 2) {
                        $builder->whereHas('containerDelivery', function ($limit) {
                            $limit->whereBetween('arrival_cartage_advised', [now()->startOfMonth(), now()->endOfMonth()]);;
                        });
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
                        $builder->where('container_mode', '=', 'LCL');
                    } elseif ($value === 1) {
                        $builder->where('container_mode', '=', 'FCL');
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
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->where('transport_mode', '=', 'AIR');
                        });
                    } elseif ($value == 2) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->where('transport_mode', '=', 'ROA');
                        });
                    }elseif ($value == 3) {
                        $builder->whereHas('shipment', function ($limit) {
                            $limit->where('transport_mode', '=', 'RAI');
                        });
                    }
                }),
        ];
    }

    public function removeFromFavorites()
    {
        $ids = $this->getSelected();

        if (empty($ids))
        {
            toast()->warning('No records where selected from the table','Warning')->push();
        } else {
            $containers = Container::findMany($ids)->pluck('container_no');

            DB::table('favorites')->where('user_id', auth()->user()->id)->whereIn('favorable_reference', $containers)->delete();

            $this->emit('refreshComponent');

            toast()->info($containers->count().' records have been removed from your list', 'Success')->push();
        }


        $this->clearSelected();
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
                return Excel::download(new CardClickExport($this->GetContainersHeadersAndData($containers)), 'FavoritesContainerTableExport.xlsx');
            }
            else
            {
                toast()->warning('No records where selected from the table','Warning')->push();
            }
        }
    }

    public function GetContainersHeadersAndData($query)
    {
        $headers = [
            'Container Number', 'Container Mode','Container Type','Shipment Reference','PO Number','House Reference','Transport Mode','Consignee',
            'Consignor','Loading Port','Discharge Port','Vessel/Flight Name','Voyage Reference','Estimated Departure',
            'Estimated Arrival', 'Actual Arrival', 'Port Arrival','Cleared Date', 'Estimated Delivery Date',
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
            $exportCollection[$key]['Actual Arrival'] = $data->shipment->actual_arrival ?? null;
            $exportCollection[$key]['Port Arrival'] = $data->shipment->port_arrival_date ?? $data->estimated_arrival ?? null;
            $exportCollection[$key]['Cleared Date'] = $data->shipment->cleared_date ?? null;
            $exportCollection[$key]['Estimated Delivery Date'] = $data->shipment->estimated_delivery ?? null;
            $exportCollection[$key]['Consignee Collection Address'] = $data->shipment->consignee_pick_up_address ?? null;
            $exportCollection[$key]['Container Delivery Date'] = $data->container_delivery ?? null;
        }

        return [$headers,$exportCollection];
    }
}
