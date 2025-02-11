<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'is_admin' => true,
            ],
            [
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false,
            ]
        ];

        foreach ($user as $dt) {
            User::create($dt);
        }
    }
}
