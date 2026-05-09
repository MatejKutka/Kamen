<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {

        //php artisan db:seed --class=AdminUserSeeder ak by trebalo spustit tento seeder samostatne
        User::updateOrCreate(
            [
                'email' => 'admin@kamen.sk',
            ],
            [
                'name' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'Kamen',
                'phone_number' => null,
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ]
        );
    }
}