<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BellPushNotification extends Notification
{
    use Queueable;

    public $notifiation;

    public function __construct($notification)
    {
        $this->notifiation = $notification;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            $this->notifiation
        ];
    }
}
