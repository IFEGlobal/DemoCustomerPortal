<?php

namespace App\Http\Livewire\MySpace;

use App\Models\Container;
use App\Models\ContainerDelivery;
use App\Models\Document;
use App\Models\Favorite;
use App\Models\Priority;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use WireUi\Traits\Actions;

class Priorities extends Component
{
    use WireToast;

    public ?string $selectedCategory = null;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function goToLiveDashboard()
    {
        return redirect()->to('/dashboard');
    }

    public function goToCalendar()
    {
        return redirect()->to('/calendar');
    }

    public function goToFavorites()
    {
        return redirect()->to('/space/favorites');
    }

    public function changeTable($id)
    {
        if($id == 1)
        {
            $this->selectedCategory = 'Shipments';
        }elseif ($id == 2)
        {
            $this->selectedCategory = 'Containers';
        }elseif ($id == 3)
        {
            $this->selectedCategory = 'Deliveries';
        }elseif ($id == 4)
        {
            $this->selectedCategory = 'Documents';
        }
    }

    public function removeSuggested($table)
    {
        $priorities = Priority::query()->where('user_id', auth()->user()->id)->get();

        if($table == 'Shipments')
        {
            $getShipments = Shipment::whereIn('shipment_ref', $priorities
                ->where('prioratable_type','=', 'App\Models\Shipment')
                ->pluck('prioratable_reference')->toArray())
                ->where('estimated_arrival', '<', now()->subDays(3))
                ->pluck('shipment_ref');

            DB::table('priorities')->whereIn('prioratable_reference', $getShipments)->where('prioratable_type', 'App\Models\Shipment')->delete();

            $this->emit('refreshComponent');

            toast()->info($getShipments->count().' Shipments removed from priorities','Success')->push();

        }elseif ($table == 'Containers')
        {
            $getContainers = Container::whereIn('container_no', $priorities
                ->where('prioratable_type','=', 'App\Models\Container')
                ->pluck('prioratable_reference')->toArray())
                ->wherehas('shipment', function($limit){
                    $limit->where('estimated_arrival', '<', now()->subDays(3));
                })->pluck('container_no');

            DB::table('priorities')->whereIn('prioratable_reference', $getContainers)->where('prioratable_type', 'App\Models\Container')->delete();

            $this->emit('refreshComponent');

            toast()->info($getContainers->count().' Containers removed from priorities','Success')->push();

        }elseif ($table == 'Deliveries')
        {
            $getDeliveries = ContainerDelivery::whereIn('container_id', $priorities
                ->where('prioratable_type','=', 'App\Models\ContainerDelivery')
                ->pluck('prioratable_reference')->toArray())
                ->where('arrival_estimated_delivery', '<', now()->subDay())
                ->pluck('container_id');

            foreach ($getDeliveries as $getDelivery) {
                $getIds[] = (string) $getDelivery;
            }

            if(isset($getIds))
            {
                DB::table('priorities')->whereIn('prioratable_reference', $getIds)->where('prioratable_type', 'App\Models\ContainerDelivery')->delete();

                $this->emit('refreshComponent');

                toast()->info(count($getIds).' Deliveries removed from favorites','Success')->push();
            } else {

                $this->emit('refreshComponent');

                toast()->info('0 Deliveries have been removed from your priorities', 'Success')->push();
            }


        }elseif ($table == 'Documents')
        {
            $getDocuments = Document::whereIn('document_id', $priorities
                ->where('prioratable_type','=', 'App\Models\Document')
                ->pluck('prioratable_reference')
                ->toArray())
                ->where('saved_date', '<', now()->subMonths(6))
                ->pluck('document_id');

            DB::table('priorities')->whereIn('prioratable_reference', $getDocuments)->where('prioratable_type', 'App\Models\Document')->delete();

            $this->emit('refreshComponent');

            toast()->info($getDocuments->count().' Documents removed from favorites', 'Success')->push();
        }
    }

    public function render()
    {
        $priority = Priority::query()->where('user_id', auth()->user()->id)->get();

        $getShipments = Shipment::whereIn('shipment_ref', $priority->where('prioratable_type','=', 'App\Models\Shipment')->pluck('prioratable_reference')->toArray());
        $totalShipments = $getShipments->count();
        $shipmentToRemove = $getShipments->where('estimated_arrival', '<', now()->subDays(3))->count();

        $getContainers = Container::whereIn('container_no', $priority->where('prioratable_type','=', 'App\Models\Container')->pluck('prioratable_reference')->toArray());
        $totalContainers = $getContainers->count();
        $containerToRemove = $getContainers->wherehas('shipment', function ($limit){$limit->where('estimated_arrival', '<', now()->subDays(3));})->count();

        $getDeliveries = ContainerDelivery::whereIn('container_id', $priority->where('prioratable_type','=', 'App\Models\ContainerDelivery')->pluck('prioratable_reference')->toArray());
        $totalDeliveries = $getDeliveries->count();
        $deliveriesToRemove = $getDeliveries->where('arrival_estimated_delivery', '<', now()->subDay())->count();

        $getDocuments = Document::whereIn('document_id', $priority->where('prioratable_type','=', 'App\Models\Document')->pluck('prioratable_reference')->toArray());
        $totalDocuments = $getDocuments->count();
        $oldDocuments = $getDocuments->where('saved_date', '<', now()->subMonths(6))->count();


        return view('livewire..my-space.priorities', [
                'totalShipments' => $totalShipments,
                'shipmentToRemove' => $shipmentToRemove,
                'totalContainers' => $totalContainers,
                'containersToRemove' => $containerToRemove,
                'totalDeliveries' => $totalDeliveries,
                'deliveriesToRemove' => $deliveriesToRemove,
                'totalDocuments' => $totalDocuments,
                'oldDocuments' => $oldDocuments,
                'category' => $this->selectedCategory
            ]
        );
    }
}
