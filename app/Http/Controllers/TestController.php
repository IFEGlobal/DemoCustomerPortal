<?php

namespace App\Http\Controllers;

use App\DataResources\NotificationSettingsResource;
use App\Jobs\AutomatedShipmentEvent;
use App\Models\Access;
use App\Models\AccessActivity;
use App\Models\Document;
use App\Models\Ownership;
use App\Models\Shipment;
use App\Models\User;
use App\Models\UserNotificationSetting;
use App\Services\DataService\ForwarderMiddleware;
use App\Services\OutboundService\FindServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class TestController extends Controller
{
    public function store(Request $request)
    {
        $key = 'ce24c34b-878a-491f-9c18-c55669b2f336';

        if($request->header('APIKey') != $key)
        {
            return 'Unauthorised';
        }

        $data = $request->all();

        $credentials = $data['Credentials'] ?? null;

        $organisation = $data['Organisation'] ?? null;

        $clientCode = $data['ClientCode'] ?? null;

        $ownership = Ownership::where('company_name', $organisation)->first();

        dd($data);

        if($ownership)
        {
            $createAccount = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'email_verified_at' => Carbon::parse($credentials['email_verified_at']),
                'password' => bcrypt($credentials['password']),
                'status' => $credentials['status'],
                'last_login_at' => $credentials['last_login_at'] ?? null,
                'last_login_ip_address' => $credentials['last_login_ip_address'] ?? null,
                'account_owner' => $credentials['account_owner'] ?? null,
                'avatar' => $credentials['avatar'] ?? null,
                'remember_token' => $credentials['remember_token'] ?? null,
            ]);

            if($createAccount)
            {
                $createAccess = Access::create([
                    'user_id' => $createAccount->id,
                    'record_ownership_id' => $ownership->id,
                    'schema' => $ownership->schema,
                    'client_code' => $clientCode
                ]);

                if($createAccess)
                {
                    return 'Account Created Successfully';
                }
            }

            return 'Account Creation Failed.';
        }

        return 'Ownership Error. Not Found';
    }

    public function test()
    {

        $shipment = Shipment::find(2052);

        $controller = new StreamFileController();

        dd($controller->streamCourierUrl($shipment->id));

//        $users = User::all();
//
//
//        foreach($users as $user)
//        {
//            UserNotificationSetting::create([
//                'user_id' => $user->id,
//                'email_notifications' => NotificationSettingsResource::DefaultEmailSettings(),
//                'push_notifications' => NotificationSettingsResource::DefaultPushSettings()
//            ]);
//        }
    }

    public function outboundService(Request $request)
    {
        $data = $request->all();

        $service = new FindServices($data);

        if(isset($data['CompanyCodes']))
        {
            return $service->FindUsers();
        }

        return 'The Required Parameter Is Missing!';
    }
}
