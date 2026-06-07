<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        $admin->syncRoles(['super_admin']);

        $user = User::firstOrCreate(
            ['email' => 'user@admin.com'],
            [
                'name' => 'User Account',
                'password' => Hash::make('password'),
            ]
        );

        $user->syncRoles(['user']);
    }
}
