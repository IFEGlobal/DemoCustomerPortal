<?php

namespace App\Http\Livewire\ControlCenter;

use App\Models\Access;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\Important;
use Spatie\Permission\Models\Permission;

class EditUser extends Component
{
    public $user;

    public $name;

    public $email;

    public $password;

    public $confirm_password;

    public $permissions;

    public $organisations;

    public $set_permissions;

    public $selected_permissions = [];

    public $selected_organisations = [];

    public function mount($id)
    {
        $this->user = User::find($id);

        $this->name = $this->user->name;

        $this->email = $this->user->email;

        $this->permissions = $this->getAllPermissions();

        $this->set_permissions = $this->user->getPermissionNames()->toArray();

        $this->selected_permissions = $this->user->getPermissionNames();

        $this->organisations = Auth::user()->access->pluck('client_code')->toArray();

        $this->selected_organisations = $this->user->access->pluck('client_code')->toArray();
    }

    public function getAllPermissions()
    {
        $permissions = Permission::get();

        return $permissions;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'password_confirmation' => 'min:6'
        ];
    }

    public function update()
    {
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if(isset($this->confirm_password))
        {
            $this->user->update(['password' => bcrypt($this->password)]);
        }

        return $this->setPermissions();
    }

    public function setPermissions()
    {
        $this->user->syncPermissions($this->selected_permissions);

        $this->setOrganisationAccess();

        return $this->notifyAndRedirect();
    }

    public function setOrganisationAccess()
    {
        $accessRecord = Access::where('user_id', Auth::user()->id)->whereIn('client_code', $this->selected_organisations)->get();

        $userAccess = $this->user->access;

        $addAccess = $accessRecord->map(function ($set) use ($userAccess) {
            $verify = $userAccess->pluck('client_code')->toArray();

            if(!in_array($set->client_code, $verify))
            {
               Access::create([
                   'user_id' => $userAccess[0]->user_id,
                   'record_ownership_id' => $set->record_ownership_id,
                   'schema' => $set->schema,
                   'client_code' => $set->client_code
               ]);
            }
        });

        $revokeAccess = $userAccess->map(function ($remove) use ($accessRecord){
            $verify = $accessRecord->pluck('client_code')->toArray();

            if(!in_array($remove->client_code, $verify)) {
                $remove->delete();
            }
        });
    }

    public function notifyAndRedirect()
    {
        $notification = new Important(
            'Account Updated',
            $this->user->name.' Account has been updated successfully. Changes will have an immediate effect.',
        );

        Auth::user()->notify($notification);

        $this->notification([
            'title'       => 'Account Updated',
            'icon'        => 'success'
        ]);

        redirect()->to('/control/accounts');
    }

    public function render()
    {
        return view('livewire.control-center.edit-user');
    }
}
