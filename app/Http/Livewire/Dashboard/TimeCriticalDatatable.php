<?php

namespace App\Http\Livewire\Dashboard;

use App\Exports\CardClickExport;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TimeCritical;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TimeCriticalDatatable extends DataTableComponent
{
    protected $model = TimeCritical::class;

    public string $tableName = 'Time Critical Shipments';

    public function builder(): Builder
    {
        return TimeCritical::query()->whereDate('sail_date', '>', now())->with('shipment');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public array $bulkActions = [
        'exportSelected' => '🖨️ Export',
    ];


    public function columns(): array
    {
        return [
            Column::make("Data Identifier", 'id')
                ->searchable()
                ->deselected()
                ->sortable(),
            Column::make("Shipment Identifier", 'shipment_id')
                ->searchable()
                ->deselected()
                ->sortable(),
            Column::make("Reference", 'reference')
                ->searchable()
                ->sortable(),
            Column::make("PO Number", 'shipment.PO_number')
                ->format(fn($value, $row, Column $column) => view('datatable.PONumberBadgeComponent')->withValue($value ?? null))
                ->deselected()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Master Airway Bill", 'mawb')
                ->searchable()
                ->deselected()
                ->sortable()->collapseOnMobile(),
            Column::make("Ship Name", 'ship_name')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Voyage", 'voyage')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Port Code", 'port')
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Cleared Date", 'shipment.cleared_date')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($value ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Delivery Date",'delivered_date')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->delivered_date ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("D 3 Date",'d3_date')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->d3_date ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Completion Date",'estimated_completion_date')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->estimated_completion_date ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Completed Date",'completed_date')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->completed_date ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Sail Date",'sail_date')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->sail_date ?? null))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Est Arrival",'eta')
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($row->eta ?? null))
                ->deselected()
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            Column::make("KPI", 'completed_date')
                ->format(fn($value, $row, Column $column) => view('datatable.timecriticalbadgecomponent')->withValue(['est' => $row->estimated_completion_date, 'com' => $row->completed_date]))
                ->searchable()
                ->sortable()
                ->collapseOnMobile(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('Shipment')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('shipment', ['id' => $row->shipment_id])),
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
            $shipments = TimeCritical::findMany($ids);

            if(count($shipments))
            {
                toast()->success('We are sending the report to your browser','Downloading')->push();
                return Excel::download(new CardClickExport($this->GetTimeCriticalHeadersAndData($shipments)), 'TimeCriticalDatatable.xlsx');
            }
            else
            {
                toast()->warning('No records where selected from the table','Warning')->push();
            }
        }
    }

    public function GetTimeCriticalHeadersAndData($query)
    {
        $headers = [
            'Reference','Master Airway Bill','Ship Name','Voyage',
            'Port','Cleared Date','D3 Date',
            'Estimated Completion Date','Completed','Sail Date', 'Est Arrival',
            'KPI', 'Comments',
        ];

        foreach($query as $key => $data)
        {
            $exportCollection[$key]['reference'] = $data->reference ?? null;
            $exportCollection[$key]['Master Airway Bill'] = $data->mawb ?? null;
            $exportCollection[$key]['Ship Name'] = $data->ship_name ?? null;
            $exportCollection[$key]['Voyage'] = $data->voyage ?? null;
            $exportCollection[$key]['Port'] = $data->port ?? null;
            $exportCollection[$key]['Cleared Date'] = $data->shipment->cleared_date?->format('d/m/y') ?? null;
            $exportCollection[$key]['D-3 Date'] = $data->d3_date?->format('d/m/y') ?? null;
            $exportCollection[$key]['Estimated Completion Date'] = $data->estimated_completion_date?->format('d/m/y') ?? null;
            $exportCollection[$key]['Completed Date'] = $data->completed_date?->format('d/m/y') ?? null;
            $exportCollection[$key]['Sail Date'] = $data->sail_date?->format('d/m/y') ?? null;
            $exportCollection[$key]['Estimated Arrival'] = $data->eta?->format('d/m/y') ?? null;
            $exportCollection[$key]['KPI'] = $data->KPI ?? null;
            $exportCollection[$key]['Comments'] = $data->comments ?? null;
        }

        return [$headers,$exportCollection];
    }
}
