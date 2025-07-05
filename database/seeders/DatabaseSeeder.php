<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
                    [
                        'role' => 'pengelola',
                        'nama' => 'Joko',
                        'email' => 'admin@gmail.com',
                        'no_hp' => '6281932695520',
                        'email_verified_at' => now(),
                        'password' => Hash::make('12345678'), 
                        'remember_token' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'role' => 'penghuni',
                        'nama' => 'Fierza',
                        'email' => 'user@gmail.com',
                        'no_hp' => '62895421310104',
                        'email_verified_at' => now(),
                        'password' => Hash::make('12345678'),
                        'remember_token' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
    }
}
