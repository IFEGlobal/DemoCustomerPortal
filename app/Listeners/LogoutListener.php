<?php

namespace App\Listeners;

use App\Services\AccountService\AccessLogService;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogoutListener
{
    public function handle(Logout $event)
    {
        $service = new AccessLogService($event->user->id);
        $service->LogoutEvent();
    }
}
