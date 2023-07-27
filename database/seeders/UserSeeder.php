<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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

    }
}
