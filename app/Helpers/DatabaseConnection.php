<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseConnection
{
    public static function setConnection($params)
    {
        Config::set(['database.connections.onthefly' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'DemoShipments',
            'username' => 'root',
            'password' => 'Neverguess1%',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
        ]]);

        return DB::connection('onthefly');
    }
}
