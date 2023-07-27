<?php

namespace App\Services\APIService;

use Illuminate\Support\Facades\Http;

class TestEndpoint
{
    public $credentials;

    public $auth;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function TestEndpoint()
    {
        if($this->credentials['service_url'] == null)
        {
            return 'Failed';
        }

        if(!is_null($this->credentials['service_token']))
        {
            return $this->CheckAuth();
        }

        return $this->StartTest();
    }

    public function CheckAuth()
    {
        if($this->credentials['token_type'] == 'basic auth')
        {
            if($this->credentials['service_username'] == null OR $this->credentials['service_password'] == null)
            {
                return 'Failed, Missing Username/Password';
            }

            $this->auth = base64_encode($this->credentials['service_username'].':'. $this->credentials['service_password']);
        }

        $this->auth = $this->credentials['service_token'];

       return $this->StartTest();
    }

    public function StartTest()
    {
        $headers = [
            'Authorization' => $this->auth ?? null,
            'Content-Type' => 'application/json'
        ];

        $request = Http::withHeaders($headers)->withoutVerifying()->post($this->credentials['service_url']);
        $response = $request->getStatusCode();

        if(in_array($response, [200,202,203,204,300,302,400,401,402,403,405]))
        {
            return 'Passed With Code '.$response;
        }

        return 'Failed Server Error '.$response;
    }
}
