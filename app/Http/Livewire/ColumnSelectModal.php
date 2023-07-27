<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ColumnSelectModal extends Modal
{

    public $table;

    public $configuration;

    public $columns;

    public function getTableColumns()
    {
        $resource = new $this->resource();

        $getColumns = $resource->FindTable();

        $this->columns = collect($getColumns)->map(function ($labels){
            return $labels[1];
        });
    }

    public function render()
    {
        return view('livewire.column-select-modal');
    }
}
