<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert an admin user
        DB::table('users')->insert([
            'name' => 'Admin User',
            'username' => 'admin',
            'photo' => 'admin.jpg',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'role' => 'admin',
            'status' => 1,
            'email' => 'admin@example.com',
            'password' => Hash::make('111'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert a vendor user
        DB::table('users')->insert([
            'name' => 'Vendor User',
            'username' => 'vendor',
            'photo' => 'vendor.jpg',
            'phone' => '9876543210',
            'address' => '456 Market St',
            'role' => 'vendor',
            'status' => 1,
            'email' => 'vendor@example.com',
            'password' => Hash::make('111'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert a regular user
        DB::table('users')->insert([
            'name' => 'Regular User',
            'username' => 'user',
            'photo' => 'user.jpg',
            'phone' => '5555555555',
            'address' => '789 Park Ave',
            'role' => 'user',
            'status' => 1,
            'email' => 'user@example.com',
            'password' => Hash::make('111'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
