<?php

namespace App\Http\Controllers;

use App\Services\NotificationService\CreateNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function NotificationReceiver(Request $request)
    {
        $notificationData = $request->all();

        $service = new CreateNotification($notificationData);
        $service->FindUsers();
    }
}
