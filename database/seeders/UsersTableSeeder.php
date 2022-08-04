<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_data = [
            [
                'name' => 'Admin Ecom300',
                'email' => 'admin@ecom300.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active'
            ],
            [
                'name' => 'Seller One Ecom300',
                'email' => 'sellerone@ecom300.com',
                'password' => Hash::make('sellerone123'),
                'role' => 'seller',
                'status' => 'active'
            ],
            [
                'name' => 'Customer One Ecom300',
                'email' => 'customerone@ecom300.com',
                'password' => Hash::make('customerone123'),
                'role' => 'customer',
                'status' => 'active'
            ]
        ];

        DB::table('users')->insert($user_data);
    }
}
