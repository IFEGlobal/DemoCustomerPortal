<?php

namespace App\Http\Livewire\User\ProfilePage\Form;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use ZxcvbnPhp\Zxcvbn;

class ChangePassword extends Component
{
    use WireToast;

    public $current_password;

    public $password;

    public $password_confirmation;

    public int $strengthScore = 0;

    public array $passwordStrengthLevels = [
        1 => 'Weak',
        2 => 'Fair',
        3 => 'Good',
        4 => 'Strong'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'current_password'=> ['required'],
                'password' => [
                'required',
                'min:8',
                'confirmed',
                'different:current_password',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                ]
        ]);
    }

    public function changePassword()
    {
        $this->validate([
            'current_password'=>'required',
            'password' => 'required|min:8|confirmed|different:current_password'
        ]);

        if(Hash::check($this->current_password,Auth::user()->password))
        {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            $user->save();

            $this->reset();

            toast()->info('Your password has been changed successfully!', 'Password Updated')->push();
        }
        else
        {
            toast()->danger('Passwords does not match!', 'Error')->push();
        }
    }

    public function render()
    {
        $this->strengthScore = ( new Zxcvbn())->passwordStrength($this->password ?? '')['score'];

        return view('livewire.user.profile-page.form.change-password');
    }
}
