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
            "username"=>"ali shehab",
            "email"=>"bshehab26@gmail.com",
            "user_type"=>"admin",
            "password"=> "123456789"
            // "password"=> bcrypt("123456789")//to bcrypt the Hash
        ]);

        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'user_type' => 'admin',
            'password' => Hash::make('123456789'),
        ]);
    }
}
