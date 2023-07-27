<?php

namespace App\Services\DataService;

use App\Models\Access;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class GetOrganisationData
{
    public $company;

    public function __construct(Access $company)
    {
        $this->company = $company;
    }

    public function GetOrganisation()
    {
        if($this->company->client_code !== null)
        {
            return $this->CreatePacket();
        }

        return null;
    }

    public function CreatePacket()
    {
        $post = ['OrganisationCode' => $this->company->client_code];

        $service = new ForwarderMiddleware($this->company->recordOwnership->api_url.'/api/organisation/data', $post);

        return collect($service->SendData()) ?? null;
    }
}
