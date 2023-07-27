<?php

namespace App\Http\Livewire\User\ProfilePage;

use App\Models\EventRegistration;
use App\Models\Events;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class EditEventService extends Component
{
    use WireToast;

    public $editedServiceIndex = null;

    public $editedServiceField = null;

    public $services = [];


    protected $listeners = ['refreshChild' => '$refresh'];

    protected $rules = [
        'services.*.service_name' => ['required','string','max:255'],
        'services.*.service_url' => ['required','string','max:255'],
    ];

    protected $validationAttributes = [
        'services.*.service_name' => 'service_name',
        'services.*.service_url' => 'service_url',
    ];

    public function mount()
    {
        $this->services = EventRegistration::where('user_id', auth()->user()->id)->get()->toArray();
    }

    public function editService($serviceIndex)
    {
        $this->editedServiceIndex = $serviceIndex;
    }

    public function editServiceField($serviceIndex, $fieldName)
    {
        $this->editedProductField = $serviceIndex . '.' . $fieldName;
    }

    public function deleteService($id)
    {
        EventRegistration::find($id)->delete();

        toast()->danger('Endpoint deleted successfully', 'Endpoint Deleted')->push();
    }

    public function saveService($serviceIndex)
    {
        $this->validate();

        $service = $this->services[$serviceIndex] ?? NULL;

        if (!is_null($service)) {
            optional(EventRegistration::find($service['id']))->update($service);
        }

        $this->editedServiceIndex = null;
        $this->editedServiceField = null;
    }

    public function viewLogs($event_registration_id)
    {
        return redirect()->to('/service/logs/'.$event_registration_id);
    }

    public function render()
    {
        return view('livewire.user.profile-page.edit-event-service',
            [
                'service' => DB::table('event_registrations')->where('user_id', auth()->user()->id)->get()->toArray()
            ]);
    }

}
