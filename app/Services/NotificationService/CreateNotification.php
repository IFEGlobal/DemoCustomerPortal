<?php

namespace App\Services\NotificationService;

use App\DataResources\UsersByCodeResource;
use App\Helpers\DatabaseConnection;
use App\Notifications\BellPushNotification;
use App\Notifications\MailPushNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class CreateNotification
{
    public array $notification;

    public Model $model;

    public $users;

    public function __construct($notification)
    {
        $this->notification = $notification;

        DatabaseConnection::setConnection($notification['Schema']);
    }

    public function FindUsers()
    {
        $users = UsersByCodeResource::GetUsersByCode($this->notification['Codes']);

        if($users !== null)
        {
            $this->users = $users;

            return $this->FilterNotificationByType();
        }

        return 'No users found';
    }

    public function FilterNotificationByType()
    {
        $this->model = $this->notification['Class']::find($this->notification['Id']);

        return $this->CreateNotificationData();

    }

    public function CreateNotificationData()
    {
        $notification = [
            'id' => $this->model->id,
            'type' => $this->notification['NotificationType'],
            'subject' => $this->notification['NotificationTitle'] ?? 'Notification',
            'reference' => $this->model->shipment_ref ?? $this->model->container_no ?? $this->model->document_description ?? $this->model->transportBooking->transport_booking_ref ?? null,
            'message' => $this->notification['Notification'],
            'icon' => $this->GetNotificationIcon(class_basename($this->model)),
            'route' => $this->GetRouteByClass(class_basename($this->model),$this->model->id)
        ];

        return $this->SendPushNotification($notification);
    }

    public function GetRouteByClass($class,$id)
    {
        if($class == "Shipment")
        {
            return 'shipments/shipments/'.$id;
        }

        if($class == "Container")
        {
            return 'shipments/container/'.$id;
        }

        if($class == "Document")
        {
            return 'documents/view-document/'.$id;
        }

        if($class == "ContainerDelivery")
        {
            return 'delivery/view-delivery/'.$id;
        }

        if($class == "RouteHistory")
        {
            return 'shipments/shipments/'.$id;
        }

        return null;
    }

    public function GetNotificationIcon($class)
    {
        if($class == "Shipment")
        {
            return '/icons/cargoship-icon-1_NEW.svg';
        }

        if($class == "Container")
        {
            return '/icons/container-icon-NEW.svg';
        }

        if($class == "Document")
        {
            return '/icons/paper-NEW.svg';
        }

        if($class == "ContainerDelivery")
        {
            return '/icons/truck-NEW.svg';
        }

        if($class == "RouteHistory")
        {
            return '/icons/schedule.svg';
        }

        return null;
    }


    public function SendPushNotification($notification)
    {
        foreach($this->users as $key => $user)
        {
            if($user->notificationSettings->push_notifications[$this->notification['Permissions']] === true)
            {
                Notification::send($user, new BellPushNotification($notification));
            }

            if($user->notificationSettings->email_notifications[$this->notification['Permissions']] === true)
            {
                Notification::send($user, new MailPushNotification($notification));
            }
        }

        return 'Notifications Sent';
    }
}
