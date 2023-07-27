<?php

namespace App\Http\Controllers;

use App\Requests\APIRequestValidation;
use App\Services\APIService\ShipmentAPIRequests;
use Illuminate\Http\Request;

class APIDataController extends Controller
{
    public $shipmentAPIService;

    public function __construct()
    {
        $this->shipmentAPIService = new ShipmentAPIRequests();
    }

    public function RequestAllShipments()
    {
        return $this->shipmentAPIService->RequestAllShipments();
    }

    public function ShipmentRequest(Request $request)
    {
        $validate = APIRequestValidation::ValidateShipmentRequest($request);

        return $this->shipmentAPIService->RequestContainers($validate);
    }

    public function PONumberRequest(Request $request)
    {
        $validate = APIRequestValidation::ValidatePONumberRequest($request);

        return $this->shipmentAPIService->RequestContainersByPONumber($validate);
    }

    public function ContainerDeliveryRequest(Request $request)
    {
        $validate = APIRequestValidation::ValidateContainerRequest($request);

        return $this->shipmentAPIService->RequestContainerDelivery($validate);
    }

    public function ContainerMilestonesRequest(Request $request)
    {
        $validate = APIRequestValidation::ValidateContainerRequest($request);

        return $this->shipmentAPIService->RequestContainerMilestones($validate);
    }

    public function RequestCo2DataByShipmentRef(Request $request)
    {
        // add code here
    }
    public function dummyReciever(Request $request)
    {
        return response('Recieved', '200');
    }
}
