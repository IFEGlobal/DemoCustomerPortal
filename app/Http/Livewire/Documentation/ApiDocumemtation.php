<?php

namespace App\Http\Livewire\Documentation;

use Illuminate\Support\Str;
use Livewire\Component;

class ApiDocumemtation extends Component
{
    public $APIRequest;

    public $random;

    public $APIPacket;

    public $APIResponse;

    public $json;

    public $url;

    public $shipmentExample;

    public $deliveryExample;

    public $milestoneExample;

    public function mount()
    {
        $this->shipmentExample = json_encode($this->setShipmentExample(), JSON_PRETTY_PRINT);
        $this->deliveryExample = json_encode($this->setDeliveryExample(), JSON_PRETTY_PRINT);
        $this->milestoneExample = json_encode($this->setMilestoneExample(), JSON_PRETTY_PRINT);
    }

    public function setShipmentExample()
    {
        return [
            "ShipmentReference" => $this->random ?? Str::random(8),
            "ContainerNumber" => Str::random(11),
            "PONumber" => Str::random(9),
            "HouseBill" => Str::random(9),
            "TransportMode" => "SEA",
            "Carrier" => "Orient Overseas Container Line Ltd.",
            "CarrierSCAC" => "OOLU",
            "Vessel" => "COSCO SHIPPING PISCES",
            "Voyage.Flight.Route" => "019W",
            "LoadingPortName" => "Xiamen Gaoqi International Apt China",
            "LoadingPortUnlocode" => "CNXMN",
            "DischargePortName" => "Felixstowe United Kingdom",
            "DichargePortUnlocode" => "GBFXT",
            "EstimatedDeparture" => now()->subDays(10),
            "EstimatedArrival" => now()->addDays(10),
            "ClearanceDate" => null,
            "ConsigneeName" => "Example Consignee",
            "Supplier.Consignor" => "Example Consignor",
            "ContainerMode" => null,
            "ContainerType" => "40HC",
            "ContainerISOCode" => "45G0",
            "ContainerGoodsWeight" => "38.3000",
            "ContainerGrossWeight" => "4018.3000",
            "ContainerTareWeight" => "3980.0000",
            "ContainerDunnageWeight" => "0.0000",
            "ContainerHeight" => "9.5000",
            "ContainerWidth" => "8.0000",
            "ContainerLength" => "40.0000",
            "WeightUnit" => "KG",
            "LengthUnit" => null,
        ];
    }

    public function setDeliveryExample()
    {
        return [
            "Delivery" => [
                "ContainerType" => "40HC",
                "ContainerDescription" => "Forty foot high cube",
                "GoodsDescription" => "1 PC IRON BED",
                "OuterPackagingType" => "CTN",
                "PackagingType" => "CTN",
                "PacksQuantity" => 2,
                "CollectionFrom" => "   ",
                "DeliveryTo" => "1555 Example Street London LON 13B",
                "ContainerDeliveryDate" => now()->addDays(15),
            ]
        ];
    }

    public function setMilestoneExample()
    {
        return [
            'Tracking' => [
                'Milestones' => [
                    [
                        "DataSource" => "carrier",
                        "TransportMode" => "Vessel",
                        "LocationName" => "Xiamen Gaoqi International Apt",
                        "LocationCity" => "Xiamen Gaoqi International Apt",
                        "LocationCountry" => "China",
                        "LocationUnlocode" => "CNXMN",
                        "Latitude" => "24.5390705",
                        "Longitude" => "118.134368",
                        "EventDescription" => "Loaded on vessel",
                        "Vessel" => "COSCO SHIPPING PISCES",
                        "Voyage" => "019W",
                        "VesselIMO" => null,
                        "EventDateTime" => now()->subDays(10),
                        "IsEstimate" => false,
                    ],
                    [
                        "DataSource" => "carrier",
                        "TransportMode" => "Vessel",
                        "LocationName" => "Felixstowe",
                        "LocationCity" => "Felixstowe",
                        "LocationCountry" => "United Kingdom",
                        "LocationUnlocode" => "GBFXT",
                        "Latitude" => "51.961726",
                        "Longitude" => "1.351255",
                        "EventDescription" => "Discharged from vessel",
                        "Vessel" => "COSCO SHIPPING PISCES",
                        "Voyage" => "019W",
                        "VesselIMO" => null,
                        "EventDateTime" => now()->addDays(10),
                        "IsEstimate" => false,
                    ]
                ]
            ]
        ];
    }

    public function changeVisual()
    {
        if($this->APIRequest == 'getAllShipments'){
            $this->APIPacket = 'This is a GET Request';
            $this->url = "https://logisticsmartportal.com/api/getAllShipments";
            $this->APIResponse = json_encode([$this->CompileResponseExample(), $this->CompileResponseExample()], JSON_PRETTY_PRINT);
        }

        if($this->APIRequest == 'getShipment'){
            $this->random = Str::random(8);
            $this->APIPacket = json_encode($this->perShipmentRequest(), JSON_PRETTY_PRINT);
            $this->url = "https://logisticsmartportal.com/api/getShipment";
            $this->APIResponse = json_encode($this->CompileResponseExample(), JSON_PRETTY_PRINT);
        }

        if($this->APIRequest == 'getShipmentByPO'){
            $this->random = Str::random(8);
            $this->APIPacket = json_encode($this->perShipmentByPORequest(), JSON_PRETTY_PRINT);
            $this->url = "https://logisticsmartportal.com/api/getShipment";
            $this->APIResponse = json_encode($this->CompileResponseExample(), JSON_PRETTY_PRINT);
        }

        if($this->APIRequest == 'getMilestones'){
            $this->random = Str::random(8);
            $this->APIPacket = json_encode($this->perContainerRequest(), JSON_PRETTY_PRINT);
            $this->url = "https://logisticsmartportal.com/api/getShipment";
            $this->APIResponse = json_encode($this->setMilestoneExample(), JSON_PRETTY_PRINT);
        }

        if($this->APIRequest == 'getDeliveries'){
            $this->random = Str::random(8);
            $this->APIPacket = json_encode($this->perContainerRequest(), JSON_PRETTY_PRINT);
            $this->url = "https://logisticsmartportal.com/api/getShipment";
            $this->APIResponse = json_encode($this->CompileResponseDeliveryExample(), JSON_PRETTY_PRINT);
        }

        if($this->APIRequest == 'empty'){
            $this->random = null;
            $this->APIPacket = null;
            $this->APIResponse = null;
        }
    }

    public function perShipmentRequest()
    {
        return ['ShipmentRef' => $this->random];
    }

    public function perShipmentByPORequest()
    {
        return ['PONumber' => $this->random];
    }

    public function perContainerRequest()
    {
        return ['ContainerNumber' => $this->random];
    }

    public function CompileResponseDeliveryExample()
    {
        return [
            'Delivery' => [
                'ContainerType' => "40HC",
                "ContainerDescription" => "Forty foot high cube",
                "GoodsDescription" => "1 PC IRON BED",
                "OuterPackagingType" => "CTN",
                "PackagingType" => "CTN",
                "PacksQuantity" => 2,
                "CollectionFrom" => "   ",
                "DeliveryTo" => "1555 Example Street London LON 13B",
                "ContainerDeliveryDate" => "2023-04-04T10:28:38.378881Z"
            ]
        ];
    }

    public function CompileResponseExample()
    {
        return [
            "ShipmentReference" => $this->random ?? Str::random(8),
            "ContainerNumber" => Str::random(11),
            "PONumber" => Str::random(9),
            "HouseBill" => Str::random(9),
            "TransportMode" => "SEA",
            "Carrier" => "Orient Overseas Container Line Ltd.",
            "CarrierSCAC" => "OOLU",
            "Vessel" => "COSCO SHIPPING PISCES",
            "Voyage.Flight.Route" => "019W",
            "LoadingPortName" => "Xiamen Gaoqi International Apt China",
            "LoadingPortUnlocode" => "CNXMN",
            "DischargePortName" => "Felixstowe United Kingdom",
            "DichargePortUnlocode" => "GBFXT",
            "EstimatedDeparture" => now()->subDays(10),
            "EstimatedArrival" => now()->addDays(10),
            "ClearanceDate" => null,
            "ConsigneeName" => "Example Consignee",
            "Supplier.Consignor" => "Example Consignor",
            "ContainerMode" => null,
            "ContainerType" => "40HC",
            "ContainerISOCode" => "45G0",
            "ContainerGoodsWeight" => "38.3000",
            "ContainerGrossWeight" => "4018.3000",
            "ContainerTareWeight" => "3980.0000",
            "ContainerDunnageWeight" => "0.0000",
            "ContainerHeight" => "9.5000",
            "ContainerWidth" => "8.0000",
            "ContainerLength" => "40.0000",
            "WeightUnit" => "KG",
            "LengthUnit" => null,
            "Delivery" => [
                "ContainerType" => "40HC",
                "ContainerDescription" => "Forty foot high cube",
                "GoodsDescription" => "1 PC IRON BED",
                "OuterPackagingType" => "CTN",
                "PackagingType" => "CTN",
                "PacksQuantity" => 2,
                "CollectionFrom" => "   ",
                "DeliveryTo" => "1555 Example Street London LON 13B",
                "ContainerDeliveryDate" => now()->addDays(15),
            ],
            'Tracking' => [
                'Milestones' => [
                    [
                        "DataSource" => "carrier",
                        "TransportMode" => "Vessel",
                        "LocationName" => "Xiamen Gaoqi International Apt",
                        "LocationCity" => "Xiamen Gaoqi International Apt",
                        "LocationCountry" => "China",
                        "LocationUnlocode" => "CNXMN",
                        "Latitude" => "24.5390705",
                        "Longitude" => "118.134368",
                        "EventDescription" => "Loaded on vessel",
                        "Vessel" => "COSCO SHIPPING PISCES",
                        "Voyage" => "019W",
                        "VesselIMO" => null,
                        "EventDateTime" => now()->subDays(10),
                        "IsEstimate" => false,
                        ],
                        [
                        "DataSource" => "carrier",
                        "TransportMode" => "Vessel",
                        "LocationName" => "Felixstowe",
                        "LocationCity" => "Felixstowe",
                        "LocationCountry" => "United Kingdom",
                        "LocationUnlocode" => "GBFXT",
                        "Latitude" => "51.961726",
                        "Longitude" => "1.351255",
                        "EventDescription" => "Discharged from vessel",
                        "Vessel" => "COSCO SHIPPING PISCES",
                        "Voyage" => "019W",
                        "VesselIMO" => null,
                        "EventDateTime" => now()->addDays(10),
                        "IsEstimate" => false,
                    ]
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.documentation.api-documemtation');
    }
}
