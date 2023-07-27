<?php

namespace App\Services\DataService;

use App\Models\Document;
use App\Traits\RecordOwnershipTrait;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class RequestDocument
{
    use RecordOwnershipTrait;

    public function CreatePacket(Document $document)
    {
        if($document->shipment_id == null)
        {
            $error = [
                'Response' => 'Error',
                'Message' =>   'No Shipment Linked - Error'
            ];
        }

        if($document->document_type == null)
        {
            $error = [
                'Response' => 'Error',
                'Message' =>   'No Document Type Found - Error'
            ];
        }

        if(isset($error))
        {
            return $error;
        }

        $packet = ['DocumentId' => $document->id,];

        return $this->SendRequest($packet);
    }

    public function SendRequest($packet)
    {
        $service = new ForwarderMiddleware($this->returnUrl().'/api/shipments/document', $packet);
        return $this->ProcessResponse($service->SendData());
    }

    public function ProcessResponse($responseBody)
    {
        if(isset($responseBody['Type']))
        {
            return $responseBody['Response'];
        }

        return $this->ReturnResponse($responseBody);
    }

    public function ReturnResponse($responseBody)
    {
        return $responseBody;
    }
}
