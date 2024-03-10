<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'User',
                'email' => 'user@email.mail',
                'phone' => '+77479400950',
                'verified_at' => now(),
                'role' => 'user',
                'password' => '123',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@email.mail',
                'phone' => '+77479400950',
                'verified_at' => now(),
                'role' => 'admin',
                'password' => '123',
            ],
            [
                'name' => 'moderator',
                'email' => 'moderator@email.mail',
                'phone' => '+77479400950',
                'verified_at' => now(),
                'role' => 'moderator',
                'password' => '123',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
