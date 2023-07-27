<?php

namespace App\Http\Livewire\User\ProfilePage\Form;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class UpdateAccountInformation extends Component
{
    use WireToast;

    public $user;

    public $name;

    public $email;

    public $contact_no;

    public $job_role;

    public function mount()
    {
        $this->user = User::findOrFail(auth()->user()->id);

        $this->name = $this->user->name;

        $this->email = $this->user->email;

        $this->contact_no = $this->user->contact_no;

        $this->role = $this->user->role;
    }

    protected function rules()
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email,'.$this->user->id],
            'contact_no' => ['string','max:20'],
            'role' => ['string','max:25']
        ];
    }

    public function updateAccount()
    {
        $validatedData = $this->validate();

        $update = $this->user->update($validatedData);

        toast()->info('Account updated successfully','Account Updated')->push();
    }

    public function render()
    {
        return view('livewire.user.profile-page.form.update-account-information');
    }
}
