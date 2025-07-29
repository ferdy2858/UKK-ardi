<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            Siswa::create([
                'nama' => 'Siswa ' . $i,
                'nis' => 'NIS' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'kelas' => 'XII-' . chr(64 + (($i % 5) + 1)), // contoh: XII-A, XII-B dst
            ]);
        }
    }
}
