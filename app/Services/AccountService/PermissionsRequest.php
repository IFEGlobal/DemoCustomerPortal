<?php

namespace App\Services\AccountService;

use App\Models\Access;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;

class PermissionsRequest
{
    public function GetPermissions()
    {
        $roles = Role::pluck('name')->toArray();
        return json_encode($roles, true);
    }
}
