<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailPushNotification extends Notification
{
    use Queueable;

    public $notifiation;

    public function __construct($notification)
    {
        $this->notifiation = $notification;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello '.$notifiable->name)
            ->subject($this->notifiation['type'].' Notification')
            ->line($this->notifiation['subject']. ' Notification')
            ->line('A '.$this->notifiation['message'])
            ->line('To view this information, please login to the portal by clicking the button below.')
            ->action('Logistic Smart Portal', url($this->notifiation['route'] ?? '/dashboard'))
            ->line('Thank you for using our application!');
    }
}
