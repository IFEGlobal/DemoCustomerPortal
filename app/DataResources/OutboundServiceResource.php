<?php

namespace App\DataResources;

use App\Models\User;

class OutboundServiceResource
{
    public static function GetOutboundServiceCredentials(User $user)
    {
        if($user->has('outboundServices'))
        {
            foreach($user->outboundServices as $service)
            {
                $services[] = $service;
            }

            if(isset($services))
            {
                return $services;
            }

            return 'No Service Registered';
        }

        return 'No Service Registered';
    }
}
