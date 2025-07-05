<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'role' => 'pengelola',
                'nama' => 'Joko',
                'email' => 'admin@example.com',
                'no_hp' => '081234567890',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Password aman dengan bcrypt
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'penghuni',
                'nama' => 'Fierza',
                'email' => 'user@example.com',
                'no_hp' => '089876543210',
                'email_verified_at' => now(),
                'password' => Hash::make('userpassword'), // Password aman dengan bcrypt
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
