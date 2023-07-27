<?php

namespace App\Services\OutboundService;

use App\DataResources\OutboundServiceResource;
use App\Models\User;

class FindServices
{
    public $data;

    public $ServiceCredentials;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function FindUsers()
    {
        $users = User::whereHas('access', function ($limit) {
            $limit->whereIn('client_code', $this->data['CompanyCodes']);
        })->whereHas('outboundServices')->get();

        if($users)
        {
            return $this->LoopThroughUsers($users);
        }

        return 'No Service Registered';
    }

    public function LoopThroughUsers($users)
    {
        foreach($users as $user)
        {
            $this->ServiceCredentials[] = OutboundServiceResource::GetOutboundServiceCredentials($user);
        }

        return $this->ServiceCredentials;
    }

}
