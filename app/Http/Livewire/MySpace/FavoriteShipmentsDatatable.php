<?php

namespace App\Http\Livewire\MySpace;


use App\Exports\CardClickExport;
use App\Models\Shipment;
use App\Services\UserService\AddToFavorites;
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

class FavoriteShipmentsDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = Favorite::class;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Shipments');

        $this->setFilterLayout('slide-down');
    }

    public function builder(): Builder
    {
        $favorites = Favorite::query()->where('user_id', auth()->user()->id)->where('favorable_type', 'App\Models\Shipment')->get()->pluck('favorable_reference')->toArray();

        return Shipment::whereIn('shipment_ref', $favorites);
    }

    public array $bulkActions = [
        'exportSelected' => '🖨️ Export',

        'removeFromFavorites' => '🗑️ Remove',

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
                ->sortable(),
            Column::make('vessel')
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
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Arrival",'estimated_arrival')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->estimated_arrival ?? null))
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
                        $builder->where('updated_at', '>', Auth::user()->last_login_at);
                    } elseif ($value === 'last 24 hours') {
                        $builder->where('updated_at', '>', Carbon::parse(Auth::user()->last_login_at)->subHours(24));
                    }elseif ($value === 'this week') {
                        $builder->whereBetween('updated_at', [now()->startOfWeek(), carbon::now()]);
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
            session()->flash('message', 'You have not selected any records');
        }
        else
        {
            $shipments = Shipment::findMany($ids);

            if(count($shipments))
            {
                return Excel::download(new CardClickExport($this->GetShipmentHeadersAndData($shipments)), 'FavoritesShipmentTableExport.xlsx');
            }
            else
            {
                session()->flash('message', 'Opps. We cant seem to find any shipments');
            }
        }
    }

    public function removeFromFavorites()
    {
        $ids = $this->getSelected();

        if (empty($ids))
        {
            toast()->warning('No records where selected from the table','Warning')->push();
        }
        else
        {
            $shipments = Shipment::findMany($ids)->pluck('shipment_ref');

            DB::table('favorites')->where('user_id', auth()->user()->id)->whereIn('favorable_reference', $shipments)->delete();

            $this->emit('refreshComponent');

            toast()->info($shipments->count(), 'have been removed from your favorites list')->push();
        }

        $this->clearSelected();
    }

    public function addToPriorities()
    {
        $ids = $this->getSelected();

        if (empty($ids))
        {
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
            'Estimated Arrival', 'Actual Arrival', 'Port Arrival','Cleared Date', 'Estimated Delivery Date',
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
            $exportCollection[$key]['Actual Arrival'] = $data->actual_arrival ?? null;
            $exportCollection[$key]['Port Arrival'] = $data->port_arrival_date ?? $data->estimated_arrival ?? null;
            $exportCollection[$key]['Cleared Date'] = $data->cleared_date ?? null;
            $exportCollection[$key]['Estimated Delivery Date'] = $data->estimated_delivery ?? null;
            $exportCollection[$key]['Consignee Collection Address'] = $data->consignee_pick_up_address ?? null;
            $exportCollection[$key]['Number Of Containers'] = $data->containers()->count() ?? 0;
        }

        return [$headers,$exportCollection];
    }

}
