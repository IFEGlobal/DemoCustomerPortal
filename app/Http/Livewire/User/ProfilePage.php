<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilePage extends Component
{
    public $user;

    public $tab = "Account";

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function switchTab($tab)
    {
        $this->tab = $tab;
        $this->emit('changeTab', $tab);
    }

    public function render()
    {
        return view('livewire.user.profile-page');
    }
}
