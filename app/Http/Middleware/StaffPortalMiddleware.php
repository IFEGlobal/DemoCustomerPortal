<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StaffPortalMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if($request->header('APIKey') != config::get('app.customer_portal.receiver.key')){
            $response = 'Unauthorized';
            return response()->json($response, 413);

        }
        return $next($request);
    }
}
