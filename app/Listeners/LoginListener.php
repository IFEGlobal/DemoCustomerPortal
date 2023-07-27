<?php

namespace App\Listeners;

use App\Services\AccountService\AccessLogService;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener
{
    public function handle(Login $event)
    {
        $service = new AccessLogService($event->user->id);
        $service->LoginEvent();
    }
}
