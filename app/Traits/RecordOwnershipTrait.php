<?php

namespace App\Traits;

use App\Models\Ownership;
use Illuminate\Support\Facades\Config;


trait RecordOwnershipTrait
{
    public function returnUrl()
    {
        $schema = Config::get('database.connections.onthefly.database');

        $recordOwnership = Ownership::where('schema', '=' ,$schema)->first();

        if($recordOwnership !== null)
        {
            return $recordOwnership->api_url;
        }

        return null;
    }

    public function returnClientCodes()
    {
        $user = auth()->user();

        $access = $user->access()->pluck('client_code')->toArray();

        return $access ?? [];
    }
}
