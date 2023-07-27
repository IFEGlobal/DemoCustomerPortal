<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $show = false;

    public $resource;

    public $table;

    protected $listeners = [
        'show' => 'show'
    ];

    public function show($resource)
    {
        $this->resource = $resource;

        dd($resource);

        $this->show = true;
    }
}
