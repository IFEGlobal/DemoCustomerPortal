<?php

namespace App\Http\Livewire\ControlCenter;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class FullUsersDatatable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Status", "status")
                ->format(fn($value, $row, Column $column) => view('datatable.activebadgecomponent')->withValue($value))
                ->sortable(),
            Column::make("Last login ip address", "last_login_ip_address")
                ->format(fn($value, $row, Column $column) => view('datatable.successbadgecomponent')->withValue($value ?? null))
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($value ?? null))
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->format(fn($value, $row, Column $column) => view('datatable.datebytimebadge')->withValue($value ?? null))
                ->sortable(),
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('Edit')->title(fn($row) => '✏Edit')->location(fn ($row): string => route('editUser', ['id' => $row->id])),
                ])
        ];
    }
}
