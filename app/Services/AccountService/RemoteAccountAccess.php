<?php

namespace App\Services\AccountService;

use App\Models\Access;
use App\Models\Ownership;
use App\Models\User;

class RemoteAccountAccess
{
    public $data;

    public $ownership;

    public $user;

    public function __construct($data)
    {
        $this->data =  $data;
    }

    public function SetOwnership(): ?string
    {
        $this->ownership = $this->FindCreateOwnership();

        $this->user = $this->GetAccount();

        return $this->SetByRequest();
    }

    public function FindCreateOwnership()
    {
        $ownership = Ownership::firstOrCreate(['ownership_reference' => $this->data['OwnershipReference']['ownership_reference']], $this->data['OwnershipReference']);

        return $ownership;
    }

    public function SetByRequest(): ?string
    {
        if($this->data['RequestType'] == 'Create')
        {
            return $this->CreateAccount();
        }

        if($this->data['RequestType'] == 'Update')
        {
            return $this->UpdateAccount();
        }

        if($this->data['RequestType'] == 'Delete')
        {
            return $this->DeleteAccount();
        }

        if($this->data['RequestType'] == 'Status')
        {
            return $this->SetStatus();
        }

        if($this->data['RequestType'] == 'Revoke')
        {
            return $this->AddClientAccess();
        }

        if($this->data['RequestType'] == 'Add')
        {
            return $this->RemoveClientAccess();
        }

        if($this->data['RequestType'] == 'Edit')
        {
            return $this->EditAccount();
        }

        return 'Request not recognised';
    }

    public function CreateAccount(): ?string
    {
        if($this->user !== null)
        {
            return $this->CheckAccessOwnership();
        }

        $create = User::create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
            'status' => $this->data['status'],
        ]);

        if(isset($this->data['profile']))
        {
            $create->syncRoles($this->data['profile']);
        }

        $this->CreateClientAccess($create);

        return 'Account created';
    }

    public function UpdateAccount(): ?string
    {
        if($this->user !== null)
        {
            $updatableFields = [
                'name' => $this->data['name'] ?? null,
                'email' => $this->data['email'] ?? null,
            ];

            $fieldsToUpdate = array_diff_assoc($updatableFields,$this->user->toArray());

            $this->user->update($fieldsToUpdate);

            if(isset($this->data['profile']))
            {
                $this->user->syncRoles($this->data['profile']);
            }

            if(isset($this->data['client_name']))
            {
                $this->CreateClientAccess($this->user);

                return 'Account updated';
            }

            return 'Account updated';
        }

        return 'Account Not Found';
    }

    public function DeleteAccount(): ?string
    {
        if($this->user !== null)
        {
            return $this->CheckAdditionalAccessOwnership();
        }

        return 'Account Not Found';
    }

    public function SetStatus()
    {
        if($this->user !== null)
        {
            if($this->data['status'] === 1)
            {
                return $this->EnableAccount();
            }

            if($this->data['status'] === 0)
            {
                return $this->DisableAccount();
            }
        }

        return 'Account Not Found';
    }

    public function DisableAccount()
    {
        if($this->user !== null)
        {
            $this->ownership->update(['service_status' => 0]);

            return 'Account disabled';
        }

        return 'Account Not Found';
    }

    public function EnableAccount()
    {
        if($this->user !== null)
        {
            $this->ownership->update(['service_status' => 1]);

            return 'Account enabled';
        }

        return 'Account Not Found';
    }

    public function AddClientAccess()
    {
        if($this->user !== null)
        {
            if(isset($this->data['client_name']))
            {
                if(count($this->data['client_name']) > 1)
                {
                    foreach($this->data['client_name'] as $client)
                    {
                        $this->GrantClientAccess($client);
                    }

                    return 'Access granted';
                }

                $this->GrantClientAccess($this->data['client_name']);

                return 'Access granted';
            }

            return 'No client specified';
        }

        return 'Account Not found';
    }

    public function RemoveClientAccess()
    {
        if($this->user !== null)
        {
            if(isset($this->data['client_name']))
            {
                if(count($this->data['client_name']) > 1)
                {
                    foreach($this->data['client_name'] as $client)
                    {
                        $this->RevokeClientAccess($client);
                    }

                    return 'Access revoked';
                }

                $this->RevokeClientAccess($this->data['client_name']);

                return 'Access revoked';
            }

            return 'No client specified';
        }

        return 'Account Not Found';
    }

    public function GetAccount()
    {
        $user = User::where('email', '=', $this->data['email'])->first();

        if($user)
        {
            return $user;
        }

        return null;
    }

    public function CheckAccessOwnership(): ?string
    {
        foreach($this->user->access as $clientAccess)
        {
            if($clientAccess->record_ownership_id === $this->ownership->id)
            {
                $ownershipStatus = true;
            }
        }

        if((isset($ownershipStatus)) && ($ownershipStatus === true))
        {
            return 'Account creation failed. Account already exists';
        }

        return $this->CreateClientAccess($this->user);
    }

    public function CreateClientAccess(User $user): ?string
    {
        if(isset($this->data['client_name']))
        {
            foreach($this->data['client_name'] as $client)
            {
                Access::firstOrCreate([
                    'user_id' => $user->id,
                    'record_ownership_id' => $this->ownership->id,
                    'client_code' => $client,
                    'schema' => $this->ownership->schema]);
            }

            return 'Account created with client access';
        }

        return 'Account created without client access';
    }


    public function CheckAdditionalAccessOwnership(): ?string
    {
        $clientAccess = Access::where('user_id', $this->user->id)->groupBy('client_code')->get();

        if($clientAccess->count() > 1)
        {
            return $this->DeleteAllClientAccess();
        }

        return $this->DeleteUserAndAllAccess();

    }

    public function DeleteAllClientAccess(): ?string
    {
        $clientAccess = Access::where('user_id', $this->user->id)->where('record_ownership_id', $this->ownership->id)->get();

        foreach($clientAccess as $access)
        {
            $access->delete();
        }

        return 'Account deleted';
    }

    public function DeleteUserAndAllAccess(): ?string
    {
        foreach($this->user->access as $access)
        {
            $access->delete();
        }

        return 'Account deleted';
    }

    public function RevokeClientAccess($client)
    {
        $clientAccess = Access::where('user_id', $this->user->id)->where('record_ownership_id', $this->ownership->id)->where('client_code', $client)->first();

        if($clientAccess)
        {
            $clientAccess->delete();
        }
    }

    public function GrantClientAccess($client)
    {
        Access::firstOrCreate(['user_id' => $this->user->id,'record_ownership_id' => $this->ownership->id, 'client_code' => $client]);
    }

    public function EditAccount()
    {
        $this->user->update([
            'name' => $this->data['name'] ??  $this->user->name,
            'email' => $this->data['email'] ??  $this->user->email,
        ]);

        if(isset($this->data['password'])){
            $this->user->update([
                'password' => bcrypt($this->data['password'])
            ]);
        }

        if(isset($this->data['profile'])){
            $this->user->syncRoles($this->data['profile']);
        }

        return 'Account updated';
    }
}
