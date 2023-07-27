<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    protected $listeners = ['newNotification' => '$refresh'];

    public function markNotificationAsRead($id)
    {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    }

    public function render()
    {
        return view('livewire.user.notification-component',[
            'notifications' => Auth::user()->unreadNotifications()->get(),
        ]);
    }
}
