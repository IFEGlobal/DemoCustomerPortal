<?php

namespace App\Http\Livewire\MySpace;

use App\Models\Container;
use App\Models\ContainerDelivery;
use App\Models\Document;
use App\Models\Favorite;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Favorites extends Component
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

    public function goToPriorities()
    {
        return redirect()->to('/space/priorities');
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
        $favorites = Favorite::query()->where('user_id', auth()->user()->id)->get();

        if($table == 'Shipments')
        {
            $getShipments = Shipment::whereIn('shipment_ref', $favorites
                ->where('favorable_type','=', 'App\Models\Shipment')
                ->pluck('favorable_reference')->toArray())
                ->where('estimated_arrival', '<', now()->subDays(3))
                ->pluck('shipment_ref');

            DB::table('favorites')->whereIn('favorable_reference', $getShipments)->where('favorable_type', 'App\Models\Shipment')->delete();

            $this->emit('refreshComponent');

            toast()->info($getShipments->count().' Shipments removed from favorites','Success')->push();

        }elseif($table == 'Containers') {
            $getContainers = Container::whereIn('container_no', $favorites
                ->where('favorable_type','=', 'App\Models\Container')
                ->pluck('favorable_reference')->toArray())
                ->wherehas('shipment', function($limit){
                    $limit->where('estimated_arrival', '<', now()->subDays(3));
                })->pluck('container_no');

            DB::table('favorites')->whereIn('favorable_reference', $getContainers)->where('favorable_type', 'App\Models\Container')->delete();

            $this->emit('refreshComponent');

            toast()->info($getContainers->count().' Containers removed from favorites','Success')->push();

        }elseif ($table == 'Deliveries') {

            $getDeliveries = ContainerDelivery::whereIn('container_id', $favorites
                ->where('favorable_type','=', 'App\Models\ContainerDelivery')
                ->pluck('favorable_reference')->toArray())
                ->where('arrival_estimated_delivery', '<', now()->subDay())
                ->pluck('container_id');

            foreach ($getDeliveries as $getDelivery) {
                $getIds[] = (string) $getDelivery;
            }

            if(isset($getIds))
            {
                DB::table('favorites')->whereIn('favorable_reference', $getIds)->where('favorable_type', 'App\Models\ContainerDelivery')->delete();

                $this->emit('refreshComponent');

                toast()->info(count($getIds).' Deliveries removed from your favorites','Success')->push();
            }
            else
            {
                toast()->info('0 Deliveries removed from your favorites','Success')->push();
            }

        }elseif ($table == 'Documents')
        {
            $getDocuments = Document::whereIn('document_id', $favorites
                ->where('favorable_type','=', 'App\Models\Document')
                ->pluck('favorable_reference')
                ->toArray())
                ->where('saved_date', '<', now()->subMonths(6))
                ->pluck('document_id');

            DB::table('favorites')->whereIn('favorable_reference', $getDocuments)->where('favorable_type', 'App\Models\Document')->delete();

            $this->emit('refreshComponent');

            toast()->info($getDocuments->count().' Documents removed from favorites','Success')->push();
        }
    }

    public function render()
    {
        $favorites = Favorite::query()->where('user_id', auth()->user()->id)->get();

        $getShipments = Shipment::whereIn('shipment_ref', $favorites->where('favorable_type','=', 'App\Models\Shipment')->pluck('favorable_reference')->toArray());
        $totalShipments = $getShipments->count();
        $shipmentToRemove = $getShipments->where('estimated_arrival', '<', now()->subDays(3))->count();

        $getContainers = Container::whereIn('container_no', $favorites->where('favorable_type','=', 'App\Models\Container')->pluck('favorable_reference')->toArray());
        $totalContainers = $getContainers->count();
        $containerToRemove = $getContainers->wherehas('shipment', function ($limit){$limit->where('estimated_arrival', '<', now()->subDays(3));})->count();

        $getDeliveries = ContainerDelivery::whereIn('container_id', $favorites->where('favorable_type','=', 'App\Models\ContainerDelivery')->pluck('favorable_reference')->toArray());
        $totalDeliveries = $getDeliveries->count();
        $deliveriesToRemove = $getDeliveries->where('arrival_estimated_delivery', '<', now()->subDay())->count();

        $getDocuments = Document::whereIn('document_id', $favorites->where('favorable_type','=', 'App\Models\Document')->pluck('favorable_reference')->toArray());
        $totalDocuments = $getDocuments->count();
        $oldDocuments = $getDocuments->where('saved_date', '<', now()->subMonths(6))->count();

        return view('livewire..my-space.favorites',
            [
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
