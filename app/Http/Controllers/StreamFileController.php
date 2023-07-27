<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Shipment;
use App\Services\DataService\RequestDocument;
use Illuminate\Http\Request;

class StreamFileController extends Controller
{
    public function streamFile($id)
    {
        $getDocument = Document::find($id);

        $documentRequest = new RequestDocument();
        $document = $documentRequest->CreatePacket($getDocument);

        if(is_array($document)) {
            if(isset($document['File']))
            {
                $download = base64_decode($document['File']);
                $contents = $download;

                $headers = ['Content-Type' => 'application/pdf'];

                return response()->stream(function () use ($contents) {
                    echo $contents;
                }, 200, $headers);
            }

            return [$document['Type'].' '.$document['Response']];
        }

        return 'Something went wrong. We are currently looking into the issue';
    }

    public function streamTracking($id)
    {
        $shipment = Shipment::find($id);

        if($shipment->tracking_ref !== null){
            return $this->setUrl($shipment);
        }

        return null;
    }

    public function setUrl(Shipment $shipment)
    {
        $url = $this->loopThoughCouriers();

    }

    public function loopThoughCouriers($courierCode)
    {

    }
}
