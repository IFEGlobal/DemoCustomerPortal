<?php

namespace App\Http\Livewire\User\ProfilePage\Form;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class APITokenGenerator extends Component
{
    use WireToast;

    public $token;

    public $user;

    public $token_name;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function createToken()
    {
        $tokens = DB::table('personal_access_tokens')->where('tokenable_id', auth()->user()->id)->count();

        if($tokens < 5)
        {
            $this->validate([
                'token_name'=>'required|string|min:3|max:25',
            ]);

            $token = $this->user->createToken($this->token_name);

            if($token)
            {
                session()->flash('message', 'Copy and paste this token as it will not be shown again ');
                session()->flash('token', $token->plainTextToken);

                $this->token_name = null;
            }
        } else {
            toast()->danger('Token Limit Reached', 'Failed')->push();
        }
    }

    public function deleteToken($id)
    {
        $this->user->tokens()->where('id', $id)->delete();

        toast()->info('Token Deleted Successfully', 'Delete Token')->push();
    }

    public function render()
    {
        return view('livewire.user.profile-page.form.a-p-i-token-generator', [
            'tokens' => DB::table('personal_access_tokens')->where('tokenable_id', auth()->user()->id)->get()
        ]);
    }
}
