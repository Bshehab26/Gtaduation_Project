<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$user=User::create([
    "username"=>"ali shehab",
    "first_name"=>"ali",
    "last_name"=>"mohamed",
    "email"=>"bshehab26@gmail.com",
    "role"=>"admin",
    "password"=> "123456789"
    // "password"=> bcrypt("123456789")//to bcrypt the Hash
]);
    }
}
