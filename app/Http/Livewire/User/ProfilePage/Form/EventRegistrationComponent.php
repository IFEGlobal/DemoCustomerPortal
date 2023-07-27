<?php

namespace App\Http\Livewire\User\ProfilePage\Form;

use App\Models\EventRegistration;
use App\Services\APIService\TestEndpoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class EventRegistrationComponent extends Component
{
    use WireToast;

    public $service_name;

    public $service_url;

    public $service_token;

    public $service_token_type;

    public $password;

    public $service_username;

    public $service_password;

    public $testResult;

    protected function rules()
    {
        return [
            'service_name' => ['required', 'string', 'max:255'],
            'service_url' => ['required', 'string', 'max:255', Rule::unique('event_registrations')],
            'service_token' => ['string', 'max:225', 'nullable'],
            'service_token_type' => ['string', 'max:25', 'nullable'],
            'password' => ['required'],
        ];
    }

    public function createService()
    {
        $this->validate();

        $this->checkAuthentication();
    }

    public function checkAuthentication()
    {
        if (Hash::check($this->password, Auth::user()->password)) {
            $this->createEventRegistration();
        }
    }

    public function createEventRegistration()
    {
        $eventRegistration = EventRegistration::create([
            'user_id' => auth()->user()->id,
            'service_name' => $this->service_name,
            'service_url' => $this->service_url,
            'service_token' => $this->service_token ?? null,
            'service_username' => $this->service_username ?? null,
            'service_password' => $this->service_password ?? null,
            'token_type' => $this->service_token_type ?? null,
            'access_check_result' => $this->testEndpoint(),
            'test_date' => now(),
        ]);

        if ($eventRegistration) {
            $this->showSuccessToast();
            $this->emitTo('livewire.user.profile-page.edit-event-service','refreshChild');
            $this->reset();
        }
    }

    public function testEndpoint()
    {
        $credentials = [
            'service_name' => $this->service_name,
            'service_url' => $this->service_url,
            'service_token' => $this->service_token ?? null,
            'service_username' => $this->service_username ?? null,
            'service_password' => $this->service_password ?? null,
            'token_type' => $this->service_token_type ?? null,
        ];

        $service = new TestEndpoint($credentials);
        $this->testResult = $service->TestEndpoint();

        return $this->testResult;
    }

    public function showSuccessToast()
    {
        $message = 'Endpoint Created. Test status: ' . $this->testEndpoint();
        toast()->danger($message, 'EndPoint Test')->push();
    }

    public function render()
    {
        return view('livewire.user.profile-page.form.event-registration-component');
    }
}
