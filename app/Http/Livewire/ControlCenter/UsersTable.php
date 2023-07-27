<?php

namespace App\Http\Livewire\ControlCenter;

use App\Http\Livewire\Table;
use App\Models\Shipment;
use App\Models\User;
use App\Table\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UsersTable extends Component
{
    public function query() : Builder
    {
        return Shipment::query();
    }

    public function columns() : array
    {
        return [

        ];
    }
}
