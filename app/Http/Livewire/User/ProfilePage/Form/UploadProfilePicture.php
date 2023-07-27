<?php

namespace App\Http\Livewire\User\ProfilePage\Form;

use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class UploadProfilePicture extends Component
{
    use WithFileUploads;

    use WireToast;

    public $user;

    public $image;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function uploadPhoto(): void
    {
        $this->validate([
            'image' => ['required', 'image', 'max:10000'],
        ]);

        if(count($this->user->getMedia('avatar')) >= 1)
        {
            $this->user->clearMediaCollection('avatar');
        }

        $upload = $this->user->addMedia($this->image->getRealPath())
            ->usingName($this->user->name.'-avatar')
            ->toMediaCollection('avatar');

        if($upload)
        {
            $this->dispatchBrowserEvent('pondReset');
            toast()->info('Account updated successfully','Your avatar has been updated')->push();
        }
    }

    public function render()
    {
        return view('livewire.user.profile-page.form.upload-profile-picture');
    }
}
