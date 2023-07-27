<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Ownership;
use App\Models\User;
use Carbon\Carbon;
use Cron\DayOfWeekField;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AccountController extends Controller
{
    protected $key = 'ce24c34b-878a-491f-9c18-c55669b2f336';

    public function requestAccount(Request $request): ?string
    {
        return $this->ValidateAPIKey($request);
    }

    public function ValidateAPIKey(Request $request): ?string
    {
        if($request->header('APIKey') != $this->key)
        {
            return 'Unauthorised';
        }

        $data = $request->all();

        return $this->ValidateRequest($data);
    }

    public function ValidateRequest($data): ?string
    {
        if(!isset($data['Organisation'])){return 'Organisation Field Required';}

        if(!isset($data['ClientCode'])){return 'Client Code Field Required';}

        if(!isset($data['Credentials']['name'])){return 'Account Name Required';}

        if(!isset($data['Credentials']['email'])){return 'Email Address Required';}

        if(!isset($data['Credentials']['password'])){return 'Password Required';}

        if(!isset($data['Credentials']['status'])){return 'Status Required';}

        return $this->LocateAccount($data);
    }

    public function LocateAccount($data): ?string
    {
        $user = User::where('email', $data['Credentials']['email'])->first();

        if($user) {
            $ownership = Ownership::where('company_name', $data['Organisation'])->first();

            if($ownership){
                return $this->UpdateAccount($user,$ownership,$data);
            }

            return 'Ownership Company Not Found';
        }

        return $this->CreateAccount($data);
    }

    public function UpdateAccount(User $user,Ownership $ownership, $data): ?string
    {
        $credentials = Arr::get($data,'Credentials', null);

        $user->update([
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

        return $this->UpdateAccess($user, $ownership,$data);
    }

    public function UpdateAccess(User $user,Ownership $ownership,$data): ?string
    {
        $userAccess = Access::where('user_id', $user->id)->where('record_ownership_id', $ownership->id)->first();

        if($userAccess) {
            $userAccess->update([
                'user_id' => $user->id,
                'record_ownership_id' => $ownership->id,
                'schema' => $ownership->schema,
                'client_code' => $data['ClientCode']
            ]);

            return 'Account Updated Successfully';
        }

        return 'Could Not Locate Access';
    }

    public function CreateAccount($data): ?string
    {
        $ownership = Ownership::where('company_name', $data['Organisation'])->first();

        if($ownership) {
            return $this->AssignAccount($ownership,$data);
        }

        return 'Ownership Record Could Not Be Located';
    }

    public function AssignAccount(Ownership $ownership,$data): ?string
    {
        $credentials = Arr::get($data,'Credentials', null);

        $user = User::create([
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

        if($user) {
            return $this->AssignOwnership($ownership,$user,$data);
        }

        return 'Could Not Create Account Error';
    }

    public function AssignOwnership(Ownership $ownership, User $user,$data): ?string
    {
        $createAccess = Access::create([
            'user_id' => $user->id,
            'record_ownership_id' => $ownership->id,
            'schema' => $ownership->schema,
            'client_code' => $data['ClientCode']
        ]);

        if($createAccess)
        {
            return 'Account Created Successfully';
        }

        return 'Assign Ownership Error';
    }
}
