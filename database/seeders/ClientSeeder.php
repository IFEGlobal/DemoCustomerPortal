<?php

namespace Database\Seeders;

use App\Models\Access;
use App\Models\Ownership;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{

    public function run()
    {
        $client1 = User::create([
            'name' => 'Landlord System Access',
            'email' => 'sbez@ifeuk.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $client2 = User::create([
            'name' => 'Thomas Miles',
            'email' => 'tmiles@ifeuk.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $client3 = User::create([
            'name' => 'Jack Parish',
            'email' => 'jparish@ifeuk.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $client4 = User::create([
            'name' => 'Jamie Cramer',
            'email' => 'jcramer@ifeuk.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $ownership = Ownership::create([
            'company_name' => 'IFE Global Logistics',
            'ownership_reference' => 'b9e62432-4461-43e4-be9f-ab2698071803',
            'api_url' => 'https://ifeglobal.fyisolutions.co.uk',
            'schema' => 'IFEGlobalLogisticsUKLtd',
            'service_status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $access = [
            [
                'user_id' => $client1->id,
                'record_ownership_id' => $ownership->id,
                'schema' => $ownership->schema,
                'client_code' => 'DIST001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $client1->id,
                'record_ownership_id' => $ownership->id,
                'schema' => $ownership->schema,
                'client_code' => 'COAC002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $client2->id,
                'record_ownership_id' => $ownership->id,
                'schema' => $ownership->schema,
                'client_code' => 'DIST001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $client3->id,
                'record_ownership_id' => $ownership->id,
                'schema' => $ownership->schema,
                'client_code' => 'COAC002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $client4->id,
                'record_ownership_id' => $ownership->id,
                'schema' => $ownership->schema,
                'client_code' => 'DIST001',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach($access as $create)
        {
            Access::create($create);
        }
    }
}
