<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            $nis = 'NIS' . str_pad($i, 4, '0', STR_PAD_LEFT);
            $user = User::create([
                'name' => 'Siswa ' . $i,
                'email' => $nis . '@siswa.local',
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('siswa');

            Siswa::create([
                'user_id' => $user->id,
                'nama' => 'Siswa ' . $i,
                'nis' => $nis,
                'kelas' => 'XII-' . chr(64 + (($i % 5) + 1)), // contoh: XII-A, XII-B dst
                'saldo' => 0,
            ]);
        }
    }
}
