<?php

namespace App\Http\Livewire\Documents;

use App\Models\Shipment;
use App\Services\DataService\RequestDocument;
use App\Services\UserService\AddToFavorites;
use App\Services\UserService\AddToPriority;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Document;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Usernotnull\Toast\Concerns\WireToast;
use WireUi\Traits\Actions;

class FullDocumentsDatatable extends DataTableComponent
{
    use WireToast;

    protected $model = Document::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setEmptyMessage('No Documents');

        $this->setDefaultSort('saved_date', 'asc');

        $this->setFilterLayout('slide-down');
    }

    public array $bulkActions = [
        'addToFavorites' => '⭐ Favorite',

        'addToPriorities' => '⚡ Priority',
    ];

    public function columns(): array
    {
        return [
            Column::make("Data Identifier", "id")
                ->deselected()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("PO Number", "shipment.PO_number")
                ->format(fn($value, $row, Column $column) => view('datatable.PONumberBadgeComponent')->withValue(Str::limit($value, 10) ?? null))
                ->searchable()
                ->sortable(),
            Column::make("Related To", "shipment.shipment_ref")
                ->searchable()
                ->collapseOnMobile()
                ->deselected()
                ->sortable(),
            Column::make("Supplier/Consignor", 'shipment.consignor_name')
                ->collapseOnMobile()
                ->searchable()
                ->sortable(),
            Column::make("Owner", "document_owner")
                ->sortable()
                ->searchable(),
            Column::make("Document Type", "document_type")
                ->searchable()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Document Description", "document_description")
                ->searchable()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("File name", "file_name")
                ->searchable()
                ->deselected()
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Created On", "saved_date")
                ->collapseOnMobile()
                ->sortable(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('View')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('document', ['id' => $row->id])),
                ])
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Updated')
                ->setFilterPillTitle('Updated')
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
                        $builder->where('saved_date', '>', Carbon::parse(Auth::user()->last_login_at));
                    } elseif ($value == 1) {
                        $builder->where('saved_date', '>', now()->subHours(24));
                    }elseif ($value == 2) {
                        $builder->whereBetween('saved_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    }
                }),
            SelectFilter::make('Received')
                ->setFilterPillTitle('Received')
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
                        $builder->whereDate('saved_date', '=', today());
                    } elseif ($value == 1) {
                        $builder->whereBetween('saved_date',[ now()->startOfWeek(), now()->endOfWeek()]);
                    }elseif ($value == 2) {
                        $builder->whereBetween('saved_date', [now()->startOfMonth(), now()->endOfMonth()]);
                    }
                }),
            SelectFilter::make('Status')
                ->setFilterPillTitle('Shipment Status')
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
                        $builder->wherehas('shipment', function($limit) {
                            $limit->whereBetween('port_arrival_date', [ now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_arrival', [ now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    } elseif ($value == 1) {
                        $builder->wherehas('shipment', function($limit) {
                            $limit->whereBetween('estimated_departure', [now()->startOfWeek(), now()->endOfWeek()])->orWhereBetween('estimated_departure', [now()->startOfWeek(), now()->endOfWeek()]);
                        });
                    }elseif ($value == 2) {
                        $builder->wherehas('shipment', function($limit) {
                            $limit->where('estimated_arrival', '>', now())->where('estimated_departure', '<', now());
                        });
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
                        $builder->wherehas('shipment', function($limit) {
                            $limit->where('transport_mode', '=', 'SEA');
                        });
                    } elseif ($value == 1) {
                        $builder->wherehas('shipment', function($limit) {
                            $limit->where('transport_mode', '=', 'AIR');
                        });
                    } elseif ($value == 2) {
                        $builder->wherehas('shipment', function($limit) {
                            $limit->where('transport_mode', '=', 'ROA');
                        });
                    }elseif ($value == 3) {
                        $builder->wherehas('shipment', function($limit) {
                            $limit->where('transport_mode', '=', 'RAI');
                        });
                    }
                }),
            SelectFilter::make('Document')
                ->setFilterPillTitle('Document Type')
                ->setFilterPillValues([
                    0 => 'Invoices',
                    1 => 'House Bills',
                    2 => 'Packing List & Clearance',
                    3 => 'Arrival Notices',
                    4 => 'Other'
                ])
                ->options([
                    '' => 'All',
                    0 => 'Invoices',
                    1 => 'House Bills',
                    2 => 'Packing List & Clearance',
                    3 => 'Arrival Notices',
                    4 => 'Other',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value == 0) {
                        $builder->where('document_type', 'ARINV');
                    } elseif ($value == 1) {
                        $builder->where('document_type', 'HBL');
                    }elseif ($value == 2) {
                        $builder->whereIn('document_type', ['PAP', 'CLE', 'PKL']);
                    }elseif ($value == 3) {
                        $builder->where('document_type', 'ARN');
                    }elseif ($value == 4) {
                        $builder->whereNotIn('document_type', ['ARN','PAP','CLE','HBL','ARINV', 'PKL']);
                    }
                }),
        ];
    }

    public function exportSelected()
    {
        $ids = $this->getSelected();

        $title = 'DocumentDataExport';

        $format = 'xlsx';

        if (empty($ids))
        {
            $this->notification([
                'title'       => 'Error',
                'description' => 'None Selected',
                'icon'        => 'error'
            ]);
        } else {
            $shipments = Document::findMany($ids);
        }

        $this->clearSelected();

    }

    public function addToFavorites()
    {
        $ids = $this->getSelected();

        if (empty($ids))
        {
            toast()->warning('No records where selected from the table','Warning')->push();
        } else {

            $documents = Document::findMany($ids);

            foreach ($documents as $document)
            {
                $model = get_class($document);

                $addToFavorites = new AddToFavorites($model, $document->id, Auth::user()->id, $document->document_id);

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

            $documents = Document::findMany($ids);

            foreach ($documents as $document)
            {
                $model = get_class($document);

                $addToFavorites = new AddToPriority($model, $document->id, Auth::user()->id, $document->document_id);

                $response = $addToFavorites->CheckExistance();

                toast()->info($response['message'],$response['title'])->push();
            }
        }

        $this->clearSelected();
    }

}
