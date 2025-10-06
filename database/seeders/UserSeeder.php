<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // kamu bisa ganti password
        ]);
        User::create([
            'name' => 'HANIF',
            'email' => 'hanif@example.com',
            'password' => Hash::make('pitono'),
        ]);
        User::create([
            'name' => 'PETUGAS',
            'email' => 'petugas@example.com',
            'password' => Hash::make('tugas'), // kamu bisa ganti password
        ]);
    }
}
