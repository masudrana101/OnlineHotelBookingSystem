<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = Carbon::now();
      $user = [
        [
          'name' => 'RAST',
          'email' => 'admin@hotel.com',
          'phone' => '01234567890',
          'password' => Hash::make('12345600'),
          'type' => 'admin',
          'status' => 'active',
          'created_at' => $now,
          'updated_at' => $now,
        ], [
          'name' => 'RAST Manager',
          'email' => 'manager@hotel.com',
          'phone' => '01234567892',
          'password' => Hash::make('12345600'),
          'type' => 'manager',
          'status' => 'active',
          'created_at' => $now,
          'updated_at' => $now,
        ], [
          'name' => 'RAST Customer',
          'email' => 'customer@hotel.com',
          'phone' => '01234567891',
          'password' => Hash::make('12345600'),
          'type' => 'customer',
          'status' => 'active',
          'created_at' => $now,
          'updated_at' => $now,
        ],
      ];

      DB::table('users')->insert($user);
    }
}
