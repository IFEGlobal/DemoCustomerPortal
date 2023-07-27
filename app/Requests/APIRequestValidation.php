<?php

namespace App\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIRequestValidation
{
    public static function ValidateShipmentRequest(Request $request)
    {
        $validated = $request->validate([
            'ShipmentRef' => 'required|string|max:15'
        ]);

        if($validated)
        {
            return $validated;
        }

        return 'ShipmentRef is required';
    }

    public static function ValidatePONumberRequest(Request $request)
    {
        $validated = $request->validate([
            'PONumber' => 'required|string|max:15'
        ]);

        if($validated)
        {
            return $validated;
        }

        return 'PONumber is required';
    }

    public static function ValidateContainerRequest(Request $request)
    {
        $validated = $request->validate([
            'ContainerNumber' => 'required|string|max:15'
        ]);

        if($validated)
        {
            return $validated;
        }

        return 'ContainerNumber is required';
    }


}
