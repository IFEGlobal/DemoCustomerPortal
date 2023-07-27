<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Services\OutboundService\FindServices;
use Illuminate\Http\Request;

class OutboundReceiverController extends Controller
{
    public function retrieveOutboundServicesCredentials(Request $request)
    {
        $data = $request->all();

        $service = new FindServices($data);

        if(isset($data['CompanyCodes']))
        {
            return $service->FindUsers();
        }

        return 'The Required Parameter Is Missing!';
    }

    public function logEvent(Request $request)
    {
        $data = $request->all();

        $create = Events::create($data);

        if($create)
        {
            return 'Event Logged';
        }

        return 'Event Logging Failed';
    }
}
