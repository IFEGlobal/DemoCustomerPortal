<?php

namespace App\Http\Livewire\RightSideBar;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public function render()
    {
        return view('livewire.right-side-bar.notifications',[
            'notifications' =>  Auth::user()->readNotifications()->whereBetween('read_at',[now()->subDays(7), now()])->get(),
        ]);
    }
}
