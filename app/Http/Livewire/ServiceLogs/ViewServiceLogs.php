<?php

namespace App\Http\Livewire\ServiceLogs;

use App\Models\Events;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ViewServiceLogs extends Component
{
    use WithPagination;

    public $service;

    public $search;

    public $date = null;

    public $json = null;

    public function mount($event_registration_id)
    {
        $this->service = $event_registration_id;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function clearDate()
    {
        $this->date = null;
    }

    public function previewJson($id)
    {
        $event = Events::find($id);

        $this->json = json_encode($event->event[0], JSON_PRETTY_PRINT) ?? 'No Data';
    }

    public function closePreview()
    {
        $this->json = null;
    }

    public function render()
    {
        return view('livewire.service-logs.view-service-logs',[
            'events' => Events::whereHas('outbound_service', function ($limit) {
                $limit->where('id', $this->service);
            })->where('event', 'LIKE', '%'.$this->search.'%' ?? '')->when($this->date, function ($query, $date){
                return $query->whereDate('event_sent', $date);
            })->paginate(10),

            'eventDates' =>Events::whereHas('outbound_service', function ($limit) {$limit->where('id', $this->service);})
                ->get()
                ->groupBy(function($date) {return Carbon::parse($date->event_sent)->format('d-m-Y');
            }),
        ]);
    }
}
