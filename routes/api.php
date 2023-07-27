<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getAllShipments', [App\Http\Controllers\APIDataController::class, 'RequestAllShipments']);
    Route::post('/getShipment', [App\Http\Controllers\APIDataController::class, 'ShipmentRequest']);
    Route::post('/getShipmentByPO', [App\Http\Controllers\APIDataController::class, 'PONumberRequest']);
    Route::post('/getDelivery', [App\Http\Controllers\APIDataController::class, 'ContainerDeliveryRequest']);
    Route::post('/getMilestones', [App\Http\Controllers\APIDataController::class, 'ContainerMilestonesRequest']);
});

Route::post('/createAccount', [App\Http\Controllers\AccountController::class, 'requestAccount']);

Route::middleware('outboundService')->group(function () {
    Route::post('/outboundservice',[\App\Http\Controllers\OutboundReceiverController::class, 'retrieveOutboundServicesCredentials']);
    Route::post('/eventLoggingService',[\App\Http\Controllers\OutboundReceiverController::class, 'logEvent']);
    Route::post('/notificationService', [\App\Http\Controllers\NotificationController::class, 'NotificationReceiver']);
});
