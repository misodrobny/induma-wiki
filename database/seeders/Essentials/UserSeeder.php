<?php

namespace Database\Seeders\Essentials;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $defaultAdminUser = new User();
        $defaultAdminUser->first_given_name = 'Admin';
        $defaultAdminUser->first_family_name = 'User';
        $defaultAdminUser->email = 'admin@application.com';
        $defaultAdminUser->password = Hash::make('password');
        $defaultAdminUser->save();
    }
}
