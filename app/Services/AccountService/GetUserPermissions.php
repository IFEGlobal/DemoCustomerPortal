<?php

namespace App\Services\AccountService;

use App\Models\Access;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;

class GetUserPermissions
{
    public $data;

    public function SetVariables($data){
        $this->data = $data;
        return $this->GetUserPermissions();
    }

    public function GetUserPermissions()
    {
        $user = User::where('email', $this->data['email'])->first();

        if($user)
        {
            return json_encode($user->getRoleNames(), true);
        }

        return json_encode(['No Profiles Set'], true);
    }

}
