<?php

namespace App\Http\Livewire\User\ProfilePage;

use App\Models\AccessActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ActivityLocationComponent extends Component
{
    use WireToast;

    use WithPagination;

    public $user;

    public $password;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function killSession()
    {
        if(Hash::check($this->password,Auth::user()->password))
        {
            Auth::logoutOtherDevices($this->password);

            $this->password = null;

            toast()->info('Killing sessions', 'Logging Out Users')->push();
        }
        else
        {
            toast()->danger('Passwords does not match!', 'Error')->push();
        }

        $uuid = session()->get('session_login_uuid');

        $access = AccessActivity::whereNull('log_out')->where('user_id', auth()->user()->id)->get();

        if($access)
        {
            foreach($access as $session)
            {
                toast()->info('Killing Session'.$session->session_uuid, 'Killing')->push();

                $session->update(['log_out' => now()]);
            }
        }

        toast()->info('Session killed and logged out!', 'Killed')->push();
    }

    public function render()
    {
        $currentSessions = AccessActivity::query()->where('log_out', null)->whereBetween('log_in',[now()->subhours(12), now()]);

        return view('livewire.user.profile-page.activity-location-component', [
            'currentSessions' => AccessActivity::where('log_out', null)->whereBetween('log_in',[now()->subhours(12), now()])->where('user_id', auth()->user()->id)->get(),
            'activity' => AccessActivity::whereNotIn('id', $currentSessions->pluck('id')->toArray())->orderBy('log_in', 'desc')->where('user_id', auth()->user()->id)->paginate(9)
        ]);
    }
}
