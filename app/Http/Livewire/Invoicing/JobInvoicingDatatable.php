<?php

namespace App\Http\Livewire\Invoicing;

use App\Models\Document;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\JobInvoicing;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class JobInvoicingDatatable extends DataTableComponent
{

    public function builder(): Builder
    {
        return Document::whereHas('chargeLines', function ($limit){
                $limit->whereNull('sell_fully_paid_date')
                ->whereIn('debtor_code', Auth::user()->access->pluck('client_code')->toArray());
            });
    }

    public function configure(): void
    {
        $this->setPrimaryKey('document.id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("PO Number", "shipment.PO_number")
                ->format(fn($value, $row, Column $column) => view('datatable.PONumberBadgeComponent')->withValue(Str::limit($value, 10) ?? null))
                ->searchable()
                ->eagerLoadRelations()
                ->sortable(),
            Column::make("Supplier/Consignor", 'shipment.consignor_name')
                ->collapseOnMobile()
                ->searchable()
                ->sortable(),
            Column::make("Invoice No", "shipment.shipment_ref")
                ->sortable()
                ->searchable(),
            Column::make("Owner", "document_owner")
                ->sortable()
                ->searchable(),
            Column::make("Invoice Ref", "linked_reference")
                ->sortable()
                ->searchable(),
            Column::make('Invoice Status')
                ->label(fn ($row) => Document::find($row->id)->InvoiceOwingAttribute() ?? 'N/A')
                ->sortable(),
            Column::make('Balance')
                ->label(fn ($row) => '£'.Document::find($row->id)->outstandingBalanceAttribute() ?? 0.00)
                ->sortable(),
            Column::make('Due Date')
                ->label(fn ($row) => Document::find($row->id)->GetDueDateAttribute())
                ->sortable(),
            Column::make('Due In Days')
                ->label(fn ($row) => Document::find($row->id)->GetCountDownAttribute())
                ->sortable(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('View')->title(fn($row) => '👁️ View')->location(fn ($row): string => route('viewInvoice', ['linked_reference' => $row->linked_reference ?? 0])),
                ])

        ];
    }
}
