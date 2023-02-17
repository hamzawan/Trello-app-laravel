<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "full_name" => "haseeb awan",
            "email" => "haseeb@gmail.com",
            "username" => "haseeb123",
            "password" => Hash::make("admin@123"),    
        ]);
    }
}
