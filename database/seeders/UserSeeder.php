<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "username"   => "ali shehab",
            "first_name" => "ali",
            "last_name"  => "mohamed",
            "email"      => "bshehab26@gmail.com",
            "role"       => "admin",
            "password"   => "123456789"
            // "password"=> bcrypt("123456789")//to bcrypt the Hash
        ]);

        $user2 = User::create([
            "username"   => "admin",
            "first_name" => "This",
            "last_name"  => "admin",
            "email"      => "admin@gmail.com",
            "role"       => "admin",
            "password"   => Hash::make("123456789"),
        ]);

        $user3 = User::create([
            "username"   => "organizer",
            "first_name" => "This",
            "last_name"  => "organizer",
            "email"      => "organizer@gmail.com",
            "role"       => "organizer",
            "password"   => Hash::make("123456789"),
        ]);
    }
}
