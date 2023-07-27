<?php

namespace App\Http\Middleware;

use App\Helpers\DatabaseConnection;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SwitchDatabaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $database_name = Auth::user()->access()->orderBy('schema')->first()->schema;
            DatabaseConnection::setConnection($database_name);
        }

        return $next($request);
        dd(Config::get('database'));
    }
}
