<?php

namespace App\Http\Livewire\MySpace;

use App\Exports\CardClickExport;
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

class FavoriteDeliveriesDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = ContainerDelivery::class;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Deliveries');

        $this->setFilterLayout('slide-down');
    }

    public function builder(): Builder
    {
        $favorites = Favorite::query()->where('user_id', auth()->user()->id)->where('favorable_type', 'App\Models\ContainerDelivery')->get()->pluck('favorable_reference')->toArray();

        return ContainerDelivery::whereIn('container_id', $favorites);
    }

    public array $bulkActions = [
        'exportSelected' => '🖨️ Export',

        'removeFromFavorites' => '🗑️ Remove',

        'addToPriorities' => '⚡ Priority',
    ];

    public function columns(): array
    {
        return [
            Column::make("Data Indetifier", "id")
                ->searchable()
                ->deselected()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Container Number", 'container.container_no')
                ->searchable()
                ->sortable(),
            Column::make("PO Number", 'shipment.PO_number')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Shipment Reference", 'shipment.shipment_ref')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Container Type", "container_type")
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Description", "description")
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Delivery Date", "arrival_estimated_delivery")
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->arrival_estimated_delivery ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Last Updated", "updated_at")
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->updated_at ?? null))
                ->searchable()
                ->deselected()
                ->sortable(),
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
                        $builder->where('container_deliveries.updated_at', '>', Auth::user()->last_login_at);
                    } elseif ($value == 1) {
                        $builder->where('container_deliveries.updated_at', '>', Carbon::parse(Auth::user()->last_login_at)->subHours(24));
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

    public function removeFromFavorites()
    {
        $ids = $this->getSelected();

        if (empty($ids))
        {
            toast()->warning('No records where selected from the table','Warning')->push();
        } else {
            $deliveries = ContainerDelivery::findMany($ids)->pluck('container_id');

            foreach ($deliveries as $getArray)
            {
                $arrayIds[] = (string) $getArray;
            }

            DB::table('favorites')->where('user_id', auth()->user()->id)->whereIn('favorable_reference', $arrayIds)->delete();

            $this->emit('refreshComponent');

            toast()->info($deliveries->count().' deliveries have been removed from your favorites list', 'Success')->push();
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
                return Excel::download(new CardClickExport($this->GetDeliveryHeadersAndData($deliveries)), 'FavoritesDeliveryTableExport.xlsx');
            }
            else
            {
                toast()->warning('No records where selected from the table','Warning')->push();
            }

            $this->clearSelected();
        }
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
}
