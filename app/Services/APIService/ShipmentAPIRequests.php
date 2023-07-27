<?php

namespace App\Services\APIService;

use App\DataResources\MilestonesResource;
use App\DataResources\MilestoneTranslationResource;
use App\Models\Container;
use App\Models\ContainerDelivery;
use App\Models\Shipment;
use App\Services\DataService\ForwarderMiddleware;
use App\Services\DataService\RequestShipmentTrackingData;
use App\Traits\RecordOwnershipTrait;

class ShipmentAPIRequests
{
    use RecordOwnershipTrait;

    public $containers;

    public $response = array();

    public function RequestAllShipments()
    {
        $this->containers = Container::query()->with('shipment', 'containerDelivery')->get();

        return $this->ContructResponse();
    }

    public function RequestContainers($request)
    {
        $this->containers = Container::query()->whereHas('shipment', function ($query) use ($request){
            $query->where('shipment_ref', $request['ShipmentRef']);
        })->with('shipment', 'containerDelivery')->get();

        return $this->ContructResponse();
    }

    public function RequestContainersByPONumber($request)
    {
        $this->containers = Container::query()->whereHas('shipment', function ($query) use ($request){
            $query->where('PO_number', 'LIKE', '%'.$request['PONumber'].'%');
        })->with('shipment', 'containerDelivery')->get();

        return $this->ContructResponse();
    }

    public function RequestContainerDelivery($request)
    {
        $this->containers = Container::query()->where('container_no', $request['ContainerNumber'])->whereHas('shipment')->whereHas('containerDelivery')->get();

        return $this->ConstructDeliveryResponse();
    }

    public function RequestContainerMilestones($request)
    {
        $this->containers = Container::query()->where('container_no', $request['ContainerNumber'])->whereHas('shipment')->whereNotNull('milestones')->get();

        return $this->ConstructMilestoneResponse();
    }

    public function ConstructDeliveryResponse()
    {
        if($this->containers) {
            if(isset($this->containers)) {
                $format = $this->containers->map(function ($container) {
                    return ['Delivery' => $this->AddDeliveryData($container->containerDelivery)];
                });
            }

            $this->response = $format->toArray();

            return $this->response;
        }

        return null;
    }

    public function ConstructMilestoneResponse()
    {
        if($this->containers) {
            if(isset($this->containers)) {
                $format = $this->containers->map(function ($container) {
                    return ['Tracking' => MilestoneTranslationResource::TranslateMilestones($container, $container->milestones)];
                });
            }

            $this->response = $format->toArray();

            return $this->response;
        }

        return [];
    }

    public function ContructResponse()
    {
        if(isset($this->containers)) {
            $format = $this->containers->map(function ($container) {
                return [
                    'ShipmentReference' => $container->shipment->shipment_ref,
                    'ContainerNumber' => $container->container_no,
                    'PONumber' => $container->shipment->PO_number ?? null,
                    'HouseBill' => $container->shipment->house_ref ?? null,
                    'TransportMode' => $container->shipment->transport_mode ?? null,
                    'Carrier' => $container->shipment->carrier ?? null,
                    'CarrierSCAC' => $container->shipment->carrier_scac_code ?? null,
                    'Vessel' => $container->shipment->vessel ?? null,
                    'Voyage.Flight.Route' => $container->shipment->voyage ?? null,
                    'LoadingPortName' => $container->shipment->loading_port_name ?? null,
                    'LoadingPortUnlocode' => $container->shipment->loading_port_code ?? null,
                    'DischargePortName' => $container->shipment->disc_port_name ?? null,
                    'DichargePortUnlocode' => $container->shipment->disc_port_code ?? null,
                    'EstimatedDeparture' => $container->shipment->estimated_departure ?? null,
                    'EstimatedArrival' => $container->shipment->estimated_arrival ?? null,
                    'PortETA' => $container->shipment->port_arrival_date ?? null,
                    'ClearanceDate' => $container->shipment->cleared_date ?? null,
                    'ConsigneeName' => $container->shipment->consignee_name ?? null,
                    'Supplier.Consignor' => $container->shipment->consignor_name ?? null,
                    'ContainerMode' => $container->mode ?? null,
                    'ContainerType' => $container->container_type ?? null,
                    'ContainerISOCode' => $container->ISO_code ?? null,
                    'ContainerGoodsWeight' => $container->goods_weight ?? null,
                    'ContainerGrossWeight' => $container->gross_weight ?? null,
                    'ContainerTareWeight' => $container->tare_weight ?? null,
                    'ContainerDunnageWeight' => $container->dunnage_weight ?? null,
                    'ContainerHeight' => $container->total_height ?? null,
                    'ContainerWidth' => $container->total_width ?? null,
                    'ContainerLength' => $container->total_length ?? null,
                    'WeightUnit' => $container->weight_unit ?? null,
                    'LengthUnit' => $container->lenth_unit ?? null,
                    'Delivery' => $this->AddDeliveryData($container->containerDelivery),
                    'Tracking' => MilestoneTranslationResource::TranslateMilestones($container,$container->milestones),
                ];
            });

            $this->response =  $format->toArray();

            return $this->response;
        }

        return null;
    }

    public function AddDeliveryData($delivery)
    {
        if($delivery) {
            return [
                'TransportBookingReference' => $delivery->transportBooking->transport_booking_ref ?? null,
                'ContainerType' => $delivery->container_type ?? null,
                'ContainerDescription' => $delivery->description ?? null,
                'GoodsDescription' => $delivery->transportBooking->goods_description ?? null,
                'OuterPackagingType' => $delivery->transportBooking->outer_packs_package_type ?? null,
                'PackagingType' => $delivery->transportBooking->pack_type ?? null,
                'PacksQuantity' => $delivery->transportBooking->pack_quantity ?? null,
                'CollectionFrom' => $delivery->transportBooking->pick_up_address ?? null,
                'DeliveryTo' => $delivery->transportBooking->delivery_address ?? null,
                'ContainerDeliveryDate' => $delivery->arrival_estimated_delivery ?? null,
            ];
        }

        return null;
    }

}
