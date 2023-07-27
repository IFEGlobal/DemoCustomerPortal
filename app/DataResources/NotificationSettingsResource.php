<?php

namespace App\DataResources;

class NotificationSettingsResource
{
    public static function DefaultPushSettings()
    {
        return [
            'NewShipments' => true,
            'NewContainers' => true,
            'ShipmentUpdates' => true,
            'ShipmentArrivalNotices' => true,
            'NewDeliveries' => true,
            'DeliveryUpdates' => true,
            'DeliveryArrivalNotices' => true,
            'NewDocuments' => true,
            'NewInvoices' => true,
            'PaymentNotices' => true
        ];
    }

    public static function DefaultEmailSettings()
    {
        return [
            'NewShipments' => false,
            'NewContainers' => false,
            'ShipmentUpdates' => false,
            'ShipmentArrivalNotices' => false,
            'NewDeliveries' => false,
            'DeliveryUpdates' => false,
            'DeliveryArrivalNotices' => false,
            'NewDocuments' => false,
            'NewInvoices' => false,
            'PaymentNotices' => false
        ];
    }

    public static function AllPushSettings()
    {
        return [
            'NewShipments' => true,
            'NewContainers' => true,
            'ShipmentUpdates' => true,
            'ShipmentArrivalNotices' => true,
            'NewDeliveries' => true,
            'DeliveryUpdates' => true,
            'DeliveryArrivalNotices' => true,
            'NewDocuments' => true,
            'NewInvoices' => true,
            'PaymentNotices' => true
        ];
    }

    public static function NonePushSettings()
    {
        return [
            'NewShipments' => false,
            'NewContainers' => false,
            'ShipmentUpdates' => false,
            'ShipmentArrivalNotices' => false,
            'NewDeliveries' => false,
            'DeliveryUpdates' => false,
            'DeliveryArrivalNotices' => false,
            'NewDocuments' => false,
            'NewInvoices' => false,
            'PaymentNotices' => false
        ];
    }
}
