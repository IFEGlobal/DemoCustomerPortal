<?php

namespace App\DataResources;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersByCodeResource
{
    public static function GetUsersByCode($codes)
    {
        foreach($codes as $key => $clean)
        {
            if($clean == 'No Code')
            {
                unset($codes[$key]);
            }
        }

        $users = User::query()->whereHas('access', function ($limit) use ($codes){
            $limit->whereIn('client_code', $codes);
        })->whereHas('notificationSettings')->get();

        if(count($users))
        {
            return $users;
        }

        return null;
    }

}
