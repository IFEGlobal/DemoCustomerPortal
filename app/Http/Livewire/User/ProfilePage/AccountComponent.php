<?php

namespace App\Http\Livewire\User\ProfilePage;

use App\Models\User;
use Livewire\Component;

class AccountComponent extends Component
{
    public $changeTab = "Account";

    protected $listeners = ['changeTab'];

    public function mount()
    {
        $this->state = auth()->user()->withoutRelations()->toArray();
    }

   public function changeTab($tab)
   {
       $this->changeTab = $tab;
   }

    public function render()
    {
        return view('livewire.user.profile-page.account-component');
    }
}
