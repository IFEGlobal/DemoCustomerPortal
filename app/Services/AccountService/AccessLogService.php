<?php

namespace App\Services\AccountService;

use App\Models\AccessActivity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class AccessLogService
{
    protected $user;

    protected $Ip;

    public function __construct($id)
    {
        $this->user = User::find($id);

        $this->Ip = request()->ip();
    }

    public function LoginEvent()
    {
        $location = $this->GetLocation();

        $generateSessionUUID = Str::uuid(4);

        $create = AccessActivity::create([
            'user_id' => $this->user->id,
            'session_login_uuid' => $generateSessionUUID,
            'ip_address' => $this->Ip,
            'location_city' => $location->cityName ?? null,
            'location_region' => $location->regionName ?? null,
            'location_country' => $location->countryName ?? null,
            'location_post_zip_code' => $location->zipCode ?? null,
            'location_latitude' => $location->latitude ?? null,
            'location_longitude' => $location->longitude ?? null,
            'location_timezone' => $location->timezone ?? null,
            'log_in' => Carbon::now(),
            'log_out' => null,
        ]);

        $this->user->update(['session_id' => session()->getId()]);
    }

    public function GetLocation()
    {
        $ipAddress = (string) $this->Ip;

        $location = Location::get($ipAddress);

        if(!$location)
        {
            return null;
        }

        return $location;
    }

    public function LogoutEvent(): void
    {
        $uuid = session()->get('session_login_uuid');
        $activityLog = AccessActivity::where('session_login_uuid', $uuid)->first();

        if($activityLog)
        {
            $this->CheckForLogOut($activityLog);
        }
    }

    public function CheckForLogOut(AccessActivity $activityLog): void
    {
        $activityLog->update(['log_out' => now()]);
    }

}
