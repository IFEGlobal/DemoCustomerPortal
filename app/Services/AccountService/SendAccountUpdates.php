<?php

namespace App\Services\AccountService;

use App\Models\Access;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class SendAccountUpdates
{
    public $user;

    public $requestType;

    public function __construct(User $user, $requestType)
    {
        $this->user = $user;

        $this->requestType = $requestType;
    }

    public function CompileData()
    {
        $user = [
            'RequestType' => $this->requestType,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'status' => $this->user->status,
        ];

        $this->SendUpdate($user);
    }

    public function GetClientCodes()
    {
        if($this->user->has('access'))
        {
            foreach($this->user->access as $client)
            {
                $clientCodes[] = $client->client_code;
            }

            return $clientCodes;
        }

        return null;
    }

    public function SendUpdate($user)
    {
        $clientURL = 'https://brokersolutions.fyisolutions.co.uk/api/accounts';
        $headers = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
            'Accept' => 'application/json',
            'APIKey' => config::get('app.customer_portal.sender.key'),
        ];
        $post = json_encode($user);
        $response = Http::withHeaders($headers)->withBody($post, 'application/json')->post($clientURL);
        $responseBody = $response->getBody()->getContents();

        return $this->ProcessResponse($responseBody);
    }
}
