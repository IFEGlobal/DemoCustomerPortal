<?php

namespace App\Http\Livewire\Shipments;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Container;
use WireUi\Traits\Actions;

class ViewContainersDatatable extends DataTableComponent
{
    use Actions;

    protected $model = Container::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Shipment id", "shipment_id")
                ->sortable(),
            Column::make("Container no", "container_no")
                ->sortable(),
            Column::make("Container mode", "container_mode")
                ->sortable(),
            Column::make("Container type", "container_type")
                ->sortable(),
            Column::make("Fcl on board vessel", "fcl_on_board_vessel")
                ->sortable(),
            Column::make("Container delivery", "container_delivery")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
